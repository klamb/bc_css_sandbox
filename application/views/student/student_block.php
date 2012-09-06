<section class="listing">
			<header>
				<?php $pic_src = student_picture_src($student->student_id, $student->oauth_uid, $student->picture); ?>
				
				<img src="<?php echo $pic_src; ?>" width="25px" height="25px" class="float-left"/>
                <hgroup class="float-left">
                    <h2><?php echo $student->first . ' ' . $student->last; ?></h2>
                    <h3><?php if($student->school_id) echo $student->school;
                        if($student->year) echo ' ' . $student->year;
                        if($student->major_id) echo ' - ' . $student->major ?></h3>
                    <?php if($student->status) echo $student->status; ?>
                </hgroup>
			</header>

			<div class="float-right">
                <br />
				<span class="social-links">
					<?php
					if (!empty($student->twitter)):
					?>
					<a href="http://www.twitter.com/<?php echo $student->twitter; ?>" class="twitter" title="Twitter" target="_blank"></a>
					<?php endif;
					if (!empty($student->facebook)):
					?>
					<a href="<?php echo $student->facebook; ?>" class="facebook" title="Facebook" target="_blank"></a>
					<?php
					endif;
					if (!empty($student->linkedin)):
					?>
					<a href="<?php echo $student->linkedin; ?>" class="linkedin" title="LinkedIn" target="_blank"></a>
					<?php
					endif;
					if (!empty($student->dribbble)):
					?>
					<a href="<?php echo $student->dribbble; ?>" class="dribbble" title="Dribbble" target="_blank"></a>
					<?php
					endif;
					if (!empty($student->github)):
					?>
					<a href="<?php echo $student->github; ?>" class="github" title="Github" target="_blank"></a>
					<?php
					endif;
					?>
				</span>
				<a href="mailto:<?php echo $student->email; ?>">Contact</a>
			</div>
			<hr>
			<p>
                <b>Skills</b>: <?php echo $student->skills; ?>
                <br />
				<b>Bio</b>: <?php echo $student->bio; ?>

			</p>
</section>
		