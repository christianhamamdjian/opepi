<?php

  function find_all_opettajat($options=[]) {
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM opettajat ";
    if($visible) {
      $sql .= "WHERE visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_opettaja_by_id($id, $options=[]) {
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM opettajat ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if($visible) {
      $sql .= "AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $opettaja = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $opettaja; 
  }

  function validate_opettaja($opettaja) {
    $errors = [];

    if(is_blank($opettaja['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($opettaja['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    $postion_int = (int) $opettaja['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    $visible_str = (string) $opettaja['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
  }

  function insert_opettaja($opettaja) {
    global $db;

    $errors = validate_opettaja($opettaja);
    if(!empty($errors)) {
      return $errors;
    }

    shift_opettaja_positions(0, $opettaja['position']);
    $sql = "INSERT INTO opettajat ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $opettaja['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $opettaja['position']) . "',";
    $sql .= "'" . db_escape($db, $opettaja['visible']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_opettaja($opettaja) {
    global $db;
    $errors = validate_opettaja($opettaja);
    if(!empty($errors)) {
      return $errors;
    }

    $old_opettaja = find_opettaja_by_id($opettaja['id']);
    $old_position = $old_opettaja['position'];
    shift_opettaja_positions($old_position, $opettaja['position'], $opettaja['id']);
    $sql = "UPDATE opettajat SET ";
    $sql .= "menu_name='" . db_escape($db, $opettaja['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $opettaja['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $opettaja['visible']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $opettaja['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function delete_opettaja($id) {
    global $db;
    $old_opettaja = find_opettaja_by_id($id);
    $old_position = $old_opettaja['position'];
    shift_opettaja_positions($old_position, 0, $id);
    $sql = "DELETE FROM opettajat ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function shift_opettaja_positions($start_pos, $end_pos, $current_id=0) {
    global $db;

    if($start_pos == $end_pos) { return; }

    $sql = "UPDATE opettajat ";
    if($start_pos == 0) {
      $sql .= "SET position = position + 1 ";
      $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
    } elseif($end_pos == 0) {
      $sql .= "SET position = position - 1 ";
      $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
    } elseif($start_pos < $end_pos) {
      $sql .= "SET position = position - 1 ";
      $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
      $sql .= "AND position <= '" . db_escape($db, $end_pos) . "' ";
    } elseif($start_pos > $end_pos) {
      $sql .= "SET position = position + 1 ";
      $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
      $sql .= "AND position < '" . db_escape($db, $start_pos) . "' ";
    }
    $sql .= "AND id != '" . db_escape($db, $current_id) . "' ";

    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_all_kurssit() {
    global $db;
    $sql = "SELECT * FROM kurssit ";
    $sql .= "ORDER BY opettaja_id ASC, position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_kurssi_by_id($id, $options=[]) {
    global $db;
    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM kurssit ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if($visible) {
      $sql .= "AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $kurssi = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $kurssi; 
  }

  function validate_kurssi($kurssi) {
    $errors = [];
    if(is_blank($kurssi['opettaja_id'])) {
      $errors[] = "opettaja cannot be blank.";
    }
    if(is_blank($kurssi['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($kurssi['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $kurssi['id'] ?? '0';
    if(!has_unique_kurssi_menu_name($kurssi['menu_name'], $current_id)) {
      $errors[] = "Menu name must be unique.";
    }


    $postion_int = (int) $kurssi['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    $visible_str = (string) $kurssi['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    // content
    if(is_blank($kurssi['content'])) {
      $errors[] = "Content cannot be blank.";
    }

    return $errors;
  }

  function insert_kurssi($kurssi) {
    global $db;

    $errors = validate_kurssi($kurssi);
    if(!empty($errors)) {
      return $errors;
    }

    shift_kurssi_positions(0, $kurssi['position'], $kurssi['opettaja_id']);

    $sql = "INSERT INTO kurssit ";
    $sql .= "(opettaja_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $kurssi['opettaja_id']) . "',";
    $sql .= "'" . db_escape($db, $kurssi['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $kurssi['position']) . "',";
    $sql .= "'" . db_escape($db, $kurssi['visible']) . "',";
    $sql .= "'" . db_escape($db, $kurssi['content']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_kurssi($kurssi) {
    global $db;

    $errors = validate_kurssi($kurssi);
    if(!empty($errors)) {
      return $errors;
    }

    $old_kurssi = find_kurssi_by_id($kurssi['id']);
    $old_position = $old_kurssi['position'];
    shift_kurssi_positions($old_position, $kurssi['position'], $kurssi['opettaja_id'], $kurssi['id']);

    $sql = "UPDATE kurssit SET ";
    $sql .= "opettaja_id='" . db_escape($db, $kurssi['opettaja_id']) . "', ";
    $sql .= "menu_name='" . db_escape($db, $kurssi['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $kurssi['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $kurssi['visible']) . "', ";
    $sql .= "content='" . db_escape($db, $kurssi['content']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $kurssi['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function delete_kurssi($id) {
    global $db;

    $old_kurssi = find_kurssi_by_id($id);
    $old_position = $old_kurssi['position'];
    shift_kurssi_positions($old_position, 0, $old_kurssi['opettaja_id'], $id);

    $sql = "DELETE FROM kurssit ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_kurssit_by_opettaja_id($opettaja_id, $options=[]) {
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM kurssit ";
    $sql .= "WHERE opettaja_id='" . db_escape($db, $opettaja_id) . "' ";
    if($visible) {
      $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function count_kurssit_by_opettaja_id($opettaja_id, $options=[]) {
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT COUNT(id) FROM kurssit ";
    $sql .= "WHERE opettaja_id='" . db_escape($db, $opettaja_id) . "' ";
    if($visible) {
      $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
    $count = $row[0];
    return $count;
  }

  function shift_kurssi_positions($start_pos, $end_pos, $opettaja_id, $current_id=0) {
    global $db;

    if($start_pos == $end_pos) { return; }

    $sql = "UPDATE kurssit ";
    if($start_pos == 0) {
      $sql .= "SET position = position + 1 ";
      $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
    } elseif($end_pos == 0) {
      $sql .= "SET position = position - 1 ";
      $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
    } elseif($start_pos < $end_pos) {
      $sql .= "SET position = position - 1 ";
      $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
      $sql .= "AND position <= '" . db_escape($db, $end_pos) . "' ";
    } elseif($start_pos > $end_pos) {
      $sql .= "SET position = position + 1 ";
      $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
      $sql .= "AND position < '" . db_escape($db, $start_pos) . "' ";
    }
    $sql .= "AND id != '" . db_escape($db, $current_id) . "' ";
    $sql .= "AND opettaja_id = '" . db_escape($db, $opettaja_id) . "'";

    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }


  function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function validate_admin($admin, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($admin['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($admin['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($admin['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($admin['password'], array('min' => 6))) {
        $errors[] = "Password must contain 6 or more characters";
      } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($admin['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($admin['password'] !== $admin['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }

    return $errors;
  }

  function insert_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_admin($admin) {
    global $db;

    $password_sent = !is_blank($admin['password']);
    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE admins SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    if($password_sent) {
      $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_admin($admin) {
    global $db;
    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

?>
