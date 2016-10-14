<?php
class SAC
{
    public static function checkAccess($level)
    {
        $level = (int) $level;
        
        if (Core::$user->data['user_type'] == USER_FOUNDER)
        {
            return true;
        }
        elseif (Core::$auth->acl_get('a_') && in_array($level, array(0,1,2)))
        {
            return true;
        }
        elseif ((Core::$user->data['user_id'] != ANONYMOUS) && in_array($level, array(0,1)))
        {
            return true;
        }
        elseif ((Core::$user->data['user_id'] == ANONYMOUS) && in_array($level, array(0)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public static function checkPageAccess($acl_name = '')
    {
        $acl_name = (string) $acl_name; 

        if (!Core::$auth->acl_get($acl_name))
        {
            ob_clean();
            $view = Registry::get('Theme');
            $view->outputMessage('403');
        }
    }


	public static function SQLWhere($field)
	{
        if (Core::$user->data['user_type'] == USER_FOUNDER)
        {
            return ' 1 = 1 ';
        }
        elseif (Core::$auth->acl_get('a_'))
        {
            return " ($field = '0' OR $field = '1' OR $field = '2') ";
        }
        elseif (Core::$user->data['user_id'] != ANONYMOUS)
        {
            return " ($field = '0' OR $field = '1') ";
        }
        else
        {
            return " ($field = '0') ";
        }
	}


    public static function getLevels()
    {
        return array(
            '0' => 'Publiczne',
            '1' => 'Zarejestrowani',
            '2' => 'Redakcja',
            '3' => 'Administratorzy',
        );
    }
    
    
    public static function getLevelsSelect($option = 0)
    {
        $option = (int) $option;
        
        $options = '';
        foreach (self::getLevels() as $level => $name)
        {
            $options .= '<option value="' . $level . '"' . (($option == $level) ? ' selected="selected"' : '') . '>' . $name . '</option>';
        }

        return $options;
    }
    
    
    public static function getLevelName($option = 0)
    {
        $option = (int) $option;
        $levels = self::getLevels();
        
        if (in_array($option, array_keys($levels)))
        {
            return $levels[$option];
        }
        
        return 'N/A';  
    }
    
    
    public static function checkHash($actions = array())
    {
        $action = Input::get('action', '');
        if (!in_array($action, $actions))
        {
            return;
        }
    
        $hash = Input::get('hash', '');
        $page = Input::get('page', 'main');
        
        if (!check_link_hash($hash, $page))
        {
            trigger_error('Wystąpił błąd');
        }
    }
}

?>