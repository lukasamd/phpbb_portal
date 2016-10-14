<?php
if((Core::$user->data['user_id'] == ANONYMOUS) || (Core::$user->data['is_bot']))
{
$this->panelOpen(Core::$user->lang['LOGIN']);
?>
<form id="login-form" method="post" action="logowanie/">
  <fieldset>
  <div id="login-message"></div>
    <label for="login-username" form="login-form"><?php echo Core::$user->lang['USERNAME']; ?>:</label>
    <input type="text" name="username" id="login-username" size="12" class="textbox login-input" value="" /> 
    <label for="login-password" form="login-form"><?php echo Core::$user->lang['PASSWORD']; ?>:</label> 
		<input type="password" name="password" id="login-password" size="12" class="textbox login-input" value="" />
		
    <a href="<?php echo URL_FORUM; ?>/ucp.php?mode=sendpassword" class="blocksmall"><?php echo Core::$user->lang['FORGOT_PASS']; ?></a>   
		<a href="<?php echo URL_FORUM; ?>/ucp.php?mode=register" class="blocksmall"><?php echo Core::$user->lang['REGISTER']; ?></a>      

		<input type="hidden" name="redirect" value="<?php echo URL_SITE; ?><?php echo FUSION_REQUEST; ?>" />
		<input type="submit" name="login" value="<?php echo Core::$user->lang['LOGIN']; ?>" id="loginbutton" class="button" /> 
	</fieldset>
</form>
<?php
}
else
{
	$this->panelOpen(Core::$user->lang['PROFILE']);
	?>
	<div id="login-message"></div>
	<div class="center">
	<?php
	
	
	echo '<strong>Witaj ' . get_username_string('full', Core::$user->data['user_id'], Core::$user->data['username'], Core::$user->data['user_colour'], Core::$user->data['username']) . '</strong>';
	echo '<br />';
	
	if (Core::$user->data['user_unread_privmsg'] > 0) :
	?>
    <hr />
    <div class="center">
      <a href="<?php echo URL_FORUM; ?>/ucp.php?i=pm&amp;folder=inbox" style="color:orange;font-weight:bold">
        <img src="images/theme/prywatna_wiadomosc.gif" alt="Nowa wiadomość" />
        Nowa wiadomość!
      </a>
    </div>
  <?php endif; ?>
	
	
	<hr />
	</div>
	<a href="<?php echo URL_FORUM; ?>/ucp.php" class="block"><?php echo Core::$user->lang['PROFILE']; ?></a>
	<a href="<?php echo URL_FORUM; ?>/ucp.php?i=pm&amp;folder=inbox" class="block"><?php echo Core::$user->lang['PRIVATE_MESSAGES']; ?></a>
	<a href="<?php echo URL_FORUM; ?>/search.php?search_id=newposts" class="block"><?php echo Core::$user->lang['SEARCH_NEW']; ?></a>
  <a href="<?php echo URL_FORUM; ?>/search.php?search_id=egosearch" class="block"><?php echo Core::$user->lang['SEARCH_SELF']; ?></a>
  
  <?php
  if (Core::$auth->acl_get('u_site_access')) 
    {
      ?>
        <hr />
        <a href="<?php echo DIR_ACP; ?>index.php" class="block"><?php echo Core::$user->lang['ACP']; ?></a> 
      <?php 
    }
  ?>  
    
	<a id="logoutlink" href="<?php echo append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=logout', true, Core::$user->session_id); ?>" class="block">
    <?php echo sprintf(Core::$user->lang['LOGOUT_USER'], Core::$user->data['username']); ?>
  </a>
	<?php  
}

$this->panelClose();
?>