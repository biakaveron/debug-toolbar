<?php defined('SYSPATH') or die('No direct script access.') ?>

<!-- CSS styles (if not added to <head>) -->
<?php if (isset($styles)): ?>
	<?php echo $styles ?>
<?php endif ?>

<!-- Javascript -->
<script type="text/javascript">
<?php echo $scripts ?>
</script>

<div id="kohana-debug-toolbar">

	<!-- Toolbar -->
	<div id="debug-toolbar" class="debug-toolbar-align-<?php echo $align ?>">
	
		<!-- Kohana link -->
		<?php echo html::image(
			Kohana::config('debug_toolbar.icon_path').'/kohana.png',
			array('onclick' => 'debugToolbar.collapse()')
		) ?>
		
		<!-- Kohana icon -->
		<?php if (Kohana::config('debug_toolbar.minimized') === TRUE): ?>
			<ul id="debug-toolbar-menu" class="menu" style="display: none">
		<?php else: ?>
			<ul id="debug-toolbar-menu" class="menu">
		<?php endif ?>
			
			<!-- Kohana version -->
			<li>
				<?php echo html::anchor("http://kohanaframework.org", Kohana::VERSION, array('target' => '_blank')) ?>
			</li>
			
			<!-- Benchmarks -->
			<?php if (Kohana::config('debug_toolbar.panels.benchmarks')): ?>
				<!-- Time -->
				<li id="time" onclick="debugToolbar.show('debug-benchmarks'); return false;">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/time.png', array('alt' => 'time')) ?>
					<?php echo round(($benchmarks['application']['total_time'])*1000, 2) ?> ms
				</li>
				<!-- Memory -->
				<li id="memory" onclick="debugToolbar.show('debug-benchmarks'); return false;">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/memory.png', array('alt' => 'memory')) ?>
					<?php echo text::bytes($benchmarks['application']['total_memory']) ?>
				</li>
			<?php endif ?>
			
			<!-- Queries -->
			<?php if (Kohana::config('debug_toolbar.panels.database')): ?>
				<li id="toggle-database" onclick="debugToolbar.show('debug-database'); return false;">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/database.png', array('alt' => 'queries')) ?>
					<?php echo isset($queries) ? $query_count : 0 ?>
				</li>
			<?php endif ?>
			
			<!-- Vars -->
			<?php if (Kohana::config('debug_toolbar.panels.vars')): ?>
				<li id="toggle-vars" onclick="debugToolbar.show('debug-vars'); return false;">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/config.png', array('alt' => 'vars')) ?>
					vars
				</li>
			<?php endif ?>
			
			<!-- Ajax -->
			<?php if (Kohana::config('debug_toolbar.panels.ajax')): ?>
				<li id="toggle-ajax" onclick="debugToolbar.show('debug-ajax'); return false;" style="display: none">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/ajax.png', array('alt' => 'ajax')) ?>
					ajax (<span>0</span>)
				</li>
			<?php endif ?>
			
			<!-- Files -->
			<?php if (Kohana::config('debug_toolbar.panels.files')): ?>
				<li id="toggle-files" onclick="debugToolbar.show('debug-files'); return false;">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/page_copy.png', array('alt' => 'files')) ?>
					files
				</li>
			<?php endif ?>

			<!-- Modules -->
			<?php if (Kohana::config('debug_toolbar.panels.modules')): ?>
				<li id="toggle-modules" onclick="debugToolbar.show('debug-modules'); return false;">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/module.png', array('alt' => 'modules')) ?>
					modules
				</li>
			<?php endif ?>

			<!-- Routes -->
			<?php if (Kohana::config('debug_toolbar.panels.routes')): ?>
				<li id="toggle-routes" onclick="debugToolbar.show('debug-routes'); return false;">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/route.png', array('alt' => 'routes')) ?>
					routes
				</li>
			<?php endif ?>

			<!-- Custom data -->
			<?php if (Kohana::config('debug_toolbar.panels.customs')): ?>
				<li id="toggle-customs" onclick="debugToolbar.show('debug-customs'); return false;">
					<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/custom.png', array('alt' => 'customs')) ?>
					customs
				</li>
			<?php endif ?>

			<!-- Swap sides -->
			<li onclick="debugToolbar.swap(); return false;">
				<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/text_align_left.png', array('alt' => 'align')) ?>
			</li>
			
			<!-- Close -->
			<li class="last" onclick="debugToolbar.close(); return false;">
				<?php echo html::image(Kohana::config('debug_toolbar.icon_path').'/close.png', array('alt' => 'close')) ?>
			</li>
		</ul>
	</div>
	
	<!-- Benchmarks -->
	<?php if (Kohana::config('debug_toolbar.panels.benchmarks')): ?>
		<div id="debug-benchmarks" class="top" style="display: none;">
			<h1>Benchmarks</h1>
			<table cellspacing="0" cellpadding="0">
				<tr>
					<th align="left">benchmark</th>
					<th align="right">count</th>
					<th align="right">avg time</th>
					<th align="right">total time</th>
					<th align="right">avg memory</th>
					<th align="right">total memory</th>
				</tr>
				<?php if (count($benchmarks)):
					$application = array_pop($benchmarks);?>
					<?php foreach ((array)$benchmarks as $group => $marks): ?>
						<tr>
							<th colspan="6"><?php echo $group?></th>
						</tr>
						<?php foreach($marks as $benchmark): ?>
						<tr class="<?php echo text::alternate('odd','even')?>">
							<td align="left"><?php echo $benchmark['name'] ?></td>
							<td align="right"><?php echo $benchmark['count'] ?></td>
							<td align="right"><?php echo sprintf('%.2f', $benchmark['avg_time'] * 1000) ?> ms</td>
							<td align="right"><?php echo sprintf('%.2f', $benchmark['total_time'] * 1000) ?> ms</td>
							<td align="right"><?php echo text::bytes($benchmark['avg_memory']) ?></td>
							<td align="right"><?php echo text::bytes($benchmark['total_memory']) ?></td>
						</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
						<tr>
							<th colspan="2" align="left">APPLICATION</th>
							<th align="right"><?php echo sprintf('%.2f', $application['avg_time'] * 1000) ?> ms</th>
							<th align="right"><?php echo sprintf('%.2f', $application['total_time'] * 1000) ?> ms</th>
							<th align="right"><?php echo text::bytes($application['avg_memory']) ?></th>
							<th align="right"><?php echo text::bytes($application['total_memory']) ?></th>
						</tr>
				<?php else: ?>
					<tr class="<?php echo text::alternate('odd','even') ?>">
						<td colspan="6">no benchmarks to display</td>
					</tr>
				<?php endif ?>
			</table>
		</div>
	<?php endif ?>
	
	<!-- Database -->
	<?php if (Kohana::config('debug_toolbar.panels.database')): ?>
		<div id="debug-database" class="top" style="display: none;">
			<h1>SQL Queries</h1>
			<table cellspacing="0" cellpadding="0">
				<tr align="left">
					<th>#</th>
					<th>query</th>
					<th>time</th>
					<th>memory</th>
				</tr>
				<?php foreach ($queries as $db_profile => $stats):
					list($sub_count, $sub_time, $sub_memory) = array_pop($stats); ?>
				<tr align="left">
					<th colspan="4">DATABASE "<?php echo strtoupper($db_profile) ?>"</th>
				</tr>
					<? foreach ($stats as $num => $query): ?>
					<tr class="<?php echo text::alternate('odd','even') ?>">
						<td><?php echo $num+1 ?></td>
						<td><?php echo $query['name'] ?></td>
						<td><?php echo number_format($query['time'] * 1000, 3) ?> ms</td>
						<td><?php echo number_format($query['memory'] / 1024, 3) ?> kb</td>
					</tr>
					<?	endforeach;	?>
					<tr>
						<th>&nbsp;</th>
						<th><?php echo $sub_count ?> total</th>
						<th><?php echo number_format($sub_time * 1000, 3) ?> ms</th>
						<th><?php echo number_format($sub_memory / 1024, 3) ?> kb</th>
					</tr>
				<?php endforeach; ?>
				<?php if (count($queries) > 1): ?>
					<tr>
						<th colspan="2" align="left"><?php echo $query_count ?> TOTAL</th>
						<th><?php echo number_format($total_time * 1000, 3) ?> ms</th>
						<th><?php echo number_format($total_memory / 1024, 3) ?> kb</th>
					</tr>
				<?php endif; ?>
			</table>
		</div>
	<?php endif ?>
	
	<!-- Vars -->
	<?php if (Kohana::config('debug_toolbar.panels.vars')): ?>
		<div id="debug-vars" class="top" style="display: none;">
			<h1>Vars</h1>
			<ul class="varmenu">
				<li onclick="debugToolbar.showvar(this, 'vars-post'); return false;">POST</li>
				<li onclick="debugToolbar.showvar(this, 'vars-get'); return false;">GET</li>
				<li onclick="debugToolbar.showvar(this, 'vars-files'); return false;">FILES</li>
				<li onclick="debugToolbar.showvar(this, 'vars-server'); return false;">SERVER</li>
				<li onclick="debugToolbar.showvar(this, 'vars-cookie'); return false;">COOKIE</li>
				<li onclick="debugToolbar.showvar(this, 'vars-session'); return false;">SESSION</li>
			</ul>
			<div style="display: none;" id="vars-post">
				<?php echo isset($_POST) ? Kohana::debug($_POST) : Kohana::debug(array()) ?>
			</div>
			<div style="display: none;" id="vars-get">
				<?php echo isset($_GET) ? Kohana::debug($_GET) : Kohana::debug(array()) ?>
			</div>
			<div style="display: none;" id="vars-files">
				<?php echo isset($_FILES) ? Kohana::debug($_FILES) : Kohana::debug(array()) ?>
			</div>
			<div style="display: none;" id="vars-server">
				<?php echo isset($_SERVER) ? Kohana::debug($_SERVER) : Kohana::debug(array()) ?>
			</div>
			<div style="display: none;" id="vars-cookie">
				<?php echo isset($_COOKIE) ? Kohana::debug($_COOKIE) : Kohana::debug(array()) ?>
			</div>
			<div style="display: none;" id="vars-session">
				<?php echo isset($_SESSION) ? Kohana::debug($_SESSION) : Kohana::debug(array()) ?>
			</div>
		</div>
	<?php endif ?>
	
	<!-- Ajax Requests -->
	<?php if (Kohana::config('debug_toolbar.panels.ajax')): ?>
		<div id="debug-ajax" class="top" style="display:none;">
			<h1>Ajax</h1>
			<table cellspacing="0" cellpadding="0">
				<tr align="left">
					<th width="1%">#</th>
					<th width="150">source</th>
					<th width="150">status</th>
					<th>request</th>
				</tr>
			</table>
		</div>
	<?php endif ?>
	
	<!-- Included Files -->
	<?php if (Kohana::config('debug_toolbar.panels.files')): ?>
		<div id="debug-files" class="top" style="display: none;">
			<h1>Files</h1>
			<table cellspacing="0" cellpadding="0">
				<tr align="left">
					<th>#</th>
					<th>file</th>
					<th>size</th>
					<th>lines</th>
				</tr>
				<?php $total_size = $total_lines = 0 ?>
				<?php foreach ((array)$files as $id => $file): ?>
					<?php
					$size = filesize($file);
					$lines = count(file($file));
					?>
					<tr class="<?php echo text::alternate('odd','even')?>">
						<td><?php echo $id + 1 ?></td>
						<td><?php echo $file ?></td>
						<td><?php echo $size ?></td>
						<td><?php echo $lines ?></td>
					</tr>
					<?php
					$total_size += $size;
					$total_lines += $lines;
					?>
				<?php endforeach; ?>
				<tr align="left">
					<th colspan="2">total</th>
					<th><?php echo text::bytes($total_size) ?></th>
					<th><?php echo number_format($total_lines) ?></th>
				</tr>
			</table>
		</div>
	<?php endif ?>

	<!-- Module list -->
	<?php if (Kohana::config('debug_toolbar.panels.modules')):
			$mod_counter = 0; ?>
		<div id="debug-modules" class="top" style="display: none;">
			<h1>Modules</h1>
			<table cellspacing="0" cellpadding="0">
				<tr align="left">
					<th>#</th>
					<th>name</th>
					<th>rel path</th>
					<th>abs path</th>
				</tr>
				<?php foreach($modules as $name => $path): ?>
				<tr class="<?php echo text::alternate('odd','even')?>">
					<td><?php echo ++$mod_counter ?></td>
					<td><?php echo $name ?></td>
					<td><?php echo $path ?></td>
					<td><?php echo realpath($path) ?></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
	<?php endif ?>

	<!-- Routes -->
	<?php if (Kohana::config('debug_toolbar.panels.routes')):
			$r_counter = 0; ?>
		<div id="debug-routes" class="top" style="display: none;">
			<h1>Routes</h1>
			<table cellspacing="0" cellpadding="0">
				<tr align="left">
					<th>#</th>
					<th>name</th>
				</tr>
				<?php foreach($routes as $name => $route):
						$class = ($route == Request::instance()->route ? ' current' : ''); ?>
				<tr class="<?php echo text::alternate('odd','even').$class?>">
					<td><?php echo ++$r_counter ?></td>
					<td><?php echo $name ?></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
	<?php endif ?>

	<!-- Custom data-->
	<?php if (Kohana::config('debug_toolbar.panels.customs') && count($customs) > 0):
			$r_counter = 0; ?>
		<div id="debug-customs" class="top" style="display: none;">
			<h1>Custom data</h1>
			<ul class="sectionmenu">
				<?php foreach($customs as $section => $data): ?>
				<li onclick="debugToolbar.showvar(this, 'customs-<?php echo $section ?>'); return false;"><?php echo $section ?></li>
				<?php endforeach; ?>
			</ul>
			<?php foreach($customs as $section => $data): ?>
			<div style="display: none;" id="customs-<?php echo $section ?>">
					<pre><?php echo $data ?></pre>
			</div>
			<?php endforeach; ?>
		</div>
	<?php endif ?>
</div>