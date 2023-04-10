<h1>Login page view</h1>
<form method="POST">
	<input placeholder="email" type="email" name="email" value="<?= old_value('email'); ?>"><br>
	<div><?= $user->getError('email'); ?></div>
	<input placeholder="password" type="password" name="password" value="<?= old_value('password'); ?>">
	<div><?= $user->getError('password'); ?></div>
	<button type="submit">Login</button>
</form>