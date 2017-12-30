<?php
	ob_start();

	echo '<h3>Reviews</h3>';
	if(!empty($comments)) {
		foreach($comments as $comm) {
			$datetime = new DateTime($comm->curdate);
			$date_format = $datetime->format("F d, Y");

			echo '<div class="comment">';
			echo '<span class="rating rating_out" data-rating="'.$comm->rating.'"></span>';
			echo '<h4>'.$comm->title.'</h4>';
			echo '<div>'.$date_format.'</div>';
			echo '<h5>'.$comm->username.'</h5>';
			echo '<p>'.$comm->comment.'</p>';
			echo '</div>';
		}
	}
	else {
		echo '<h4>There are no reviews for this product</h4>';
		if(isset($user)) {
			echo '<p>Be the first to write a review<p>';
		}
	}

	$content = ob_get_contents();
	ob_end_clean();
	echo json_encode($content);
?>