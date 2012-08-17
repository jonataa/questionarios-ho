<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Hospital do Oeste');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
            echo $this->Html->meta('icon');

            echo $this->Html->css('bootstrap.min');
            echo $this->Html->css('cake.generic');            
            echo $this->Html->css('global');
            echo $this->Html->css('jquery-ui-1.8.20.custom');

            echo $this->Html->script('jquery-1.7.2.min');
            echo $this->Html->script('jquery-ui-1.8.20.custom.min');
            echo $this->Html->script('bootstrap.min');
            echo $this->Html->script('bootstrap-dropdown');

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');        
	?>
</head>
<body>
	<div id="container">
		<div id="header">
            <?php echo $this->Html->image('hec.jpg'); ?>
			<!--h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1-->
                <?php echo $this->element('logininfo'); ?>
		</div>                
		<div id="content">
                    <div class="menu-principal" style="margin-bottom: 20px; padding: 10px; background-color: #F0F8FF; border: 1px solid #E6E6FA;">
                        <?php
                        echo $this->Html->link('Questionários', array('controller' => 'questionarios', 'action' => 'index')) . ' | ';
                        echo $this->Html->link('Usuários', array('controller' => 'usuarios', 'action' => 'index'));                
                        ?>
                    </div>

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
