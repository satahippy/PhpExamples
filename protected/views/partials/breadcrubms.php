<?php if (count($items)) { ?>
	<ol class="breadcrumb">
		<?php foreach ($items as $item) { ?>
			<?php if (isset($item['url'])) { ?>
				<li><a href="<?php echo $item['url']; ?>"><?php echo htmlspecialchars($item['title']); ?></a></li>
			<?php } else { ?>
				<li class="active"><?php echo htmlspecialchars($item['title']); ?></li>
			<?php } ?>
		<?php } ?>
	</ol>
<?php } ?>