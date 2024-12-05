<?php
/* Smarty version 4.0.0, created on 2022-06-05 23:39:57
  from '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x131/asaric/templates/prijava.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_629d22ad044199_85215395',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '214c89bee3b0b007588e51ed556f2d90d8ed0682' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x131/asaric/templates/prijava.tpl',
      1 => 1654465187,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_629d22ad044199_85215395 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="grid">
            <div class="grid1">
                <img src="<?php echo $_smarty_tpl->tpl_vars['putanja']->value;?>
/materijali/run.jpg"  alt="run"> 
            </div>
            <div class="grid2">
                <br><br>
                <h2>Prijavite se i trčite!!</h2>
                <br><br><br>
                <form novalidate id="formprijava" method="post" name="formprijava">
                    <p><label for="korisnickoime"><em>Korisničko ime: </em></label>
                        <input type="text" id="korisnickoime" name="korisnickoime" size="30" maxlength="30" placeholder="korisničko ime" autofocus="autofocus" required="required" value="<?php echo $_smarty_tpl->tpl_vars['zapamtiprijavu']->value;?>
"><br>
                    <p></p> 
                        <label for="lozinka"><em>Lozinka: </em></label>
                    <input type="password" id="lozinka" name="lozinka" size="30" maxlength="30" placeholder="lozinka" required="required"><br>
                    <p>
                    <input type="checkbox" name="check" value="1"><strong> Zapamti moju prijavu</strong><br></p>
                    <input type="submit" name="prijava" value=" Prijavi se ">
                    <input type="reset" value=" Inicijaliziraj "> 
                </form>
                 <a id="novimail" href="<?php echo $_smarty_tpl->tpl_vars['putanja']->value;?>
/stranice/novi_email.php"><p>Zaboravili ste lozinku?</p></a>
                 <?php echo $_smarty_tpl->tpl_vars['obavijest']->value;?>

                <?php echo $_smarty_tpl->tpl_vars['porukaa']->value;?>

            </div>         
</div>
<?php }
}
