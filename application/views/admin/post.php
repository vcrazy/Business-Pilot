<form action="" method="post" id="post">
	<?php if(isset($post_success)): ?>
	<div class="message">
		<?php if($post_success): ?>
			Published successfully!
		<?php else: ?>
			Error publishing this!
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if(isset($error)): ?>
	<div class="message">
		<?php echo $error; ?>
	</div>
	<?php endif; ?>

	<div class="line first">
		<div class="linetext">
			Choose page:
		</div>
		<select name="pages">
			<option value="0">
				--- Choose page ---
			</option>
			<?php foreach($pages as $page): ?>
				<option value="<?php echo $page['id']; ?>">
					<?php echo $page['name']; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="line">
		<div class="linetext">
			Link:
		</div>
		<input type="text" name="link" />
	</div>
	<div class="clearfix"></div>
	<div class="linetext onlyone">
		Message:
	</div>
	<textarea name="message" class="onlyone"></textarea>
	<div class="clearfix"></div>
	<div class="line first">
		<div class="linetext">
			Picture: (only if link is present)
		</div>
		<input type="text" name="picture" />
	</div>
	<div class="line">
		<div class="linetext">
			Name: (only if link is present)
		</div>
		<input type="text" name="name" />
	</div>
	<div class="clearfix"></div>
	<div class="line first">
		<div class="linetext">
			Title: (only if link is present)
		</div>
		<input type="text" name="caption" />
	</div>
	<div class="line">
		<div class="linetext">
			Description: (only if link is present)
		</div>
		<input type="text" name="description" />
	</div>
	<div class="clearfix"></div>
	<div class="line first">
		<div class="linetext">
			Scheduled publishing:
		</div>
		<input type="checkbox" name="publish_later" value="1" />
		<input type="text" name="scheduled_publish_time" class="datetimepicker" id="scheduled" />
	</div>
	<div class="clearfix"></div>
	<div class="linesubmit">
		<input type="submit" name="save" value="Post fo Facebook" />
	</div>
</form>
