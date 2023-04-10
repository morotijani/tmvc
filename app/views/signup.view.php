<h1>Signup page view</h1>
<form method="POST">
	<input placeholder="username" type="text" name="username" value="<?= old_value('email'); ?>"><br>
	<div><?= $user->getError('username'); ?></div>
	<input placeholder="email" type="email" name="email" value="<?= old_value('username'); ?>"><br>
	<div><?= $user->getError('email'); ?></div>
	<input placeholder="password" type="password" name="password" value="<?= old_value('password'); ?>">
	<div><?= $user->getError('password'); ?></div>
	<button type="submit">Signup</button>
</form>