<?php

require_once '../dbconnect.php';

class UserLogic
{
    /**
     * User registration
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData)
    {
        $result = false;
        $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

        //put user data into array
        $arr = [];
        $arr[] = $userData['username'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);

        try{
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);
    
            return $result;

        }catch (\Exception $e){
            return $result;
        }
    }

    /**
     * User login 
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email, $password)
    {
        //result
        $result = false;
        //find user with email
        $user = self::getUserByEmail($email);

        if(!$user){
            $_SESSION['msg'] = 'email does not match';
            return $result;
        }

        //password varification
        if(password_verify($password, $user['password'])){
            //login success
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }

        $_SESSION['msg'] = 'password does not match';
        return $result;

    }

    /**
     * get user by email
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email =?';

        //put user data into array
        $arr = [];
        $arr[] = $email;

        try{
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            $user = $stmt->fetch();
            return $user;

        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * log in
     * @param void
     * @return bool $result
     */
    public static function checkLogin()
    {
        $result = false;

        if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0){
            return $result = true;
        }


        return $result;
    }

    /**
     * log out
     * @param void
     * @return bool $result
     */
    public static function logout()
    {
        $_SESSION = array();
        session_destroy();
    }
}

?>