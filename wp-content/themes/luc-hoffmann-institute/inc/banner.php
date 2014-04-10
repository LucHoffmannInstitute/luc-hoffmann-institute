<?php
/**
 * Handles page banners
 *
 * Requires Advanced Custom Fields
 * Banner images need to be repeater fields
 */
class Banner {

	function __construct($opts = array())
	{
		global $post;

		$this->options = array_merge(array(
			'id' => $post->ID,
			'shuffle' => true
		), $opts);

		$this->images = $this->getImages();
		$this->current = $this->getCurrent();
	}

	/**
	 * Check for images
	 */
	public function hasImages()
	{
		if ( $this->images )
		{
			return true;
		}

		return false;
	}

	/**
	 * Return banner image URL
	 */
	public function url()
	{
		return $this->current['url'];
	}

	/**
	 * Return banner image caption
	 */
	public function caption()
	{
		return $this->current['caption'];
	}

	/**
	 * Return banner background-position
	 */
	public function position()
	{
		return $this->current['position'];
	}

	/**
	 * Get appropriate image object for banner
	 */
	protected function getCurrent()
	{
		if (empty($this->images))
		{
			return false;
		}

		if ($this->options['shuffle'] == true)
		{
			shuffle($this->images);
		}

		return $this->images[0];
	}

	/**
	 * Get all banner images for current page
	 */
	protected function getImages()
	{
		if ( ! get_field('banner', $this->options['id']))
		{
			return false;
		}

		$images = array();

		while (has_sub_field('banner', $this->options['id'])) 
		{
			$images[] = $this->buildImage( get_sub_field('image') );
		}

		return $images;
	}

	/**
	 * Build image with attributes
	 */
	protected function buildImage($id)
	{
		$post_obj = get_post($id);

		$image_src = wp_get_attachment_image_src($id, 'banner');

		$position = get_sub_field('position', $id);

		$image = array(
			'url' => $image_src[0],
			'caption' => $post_obj->post_excerpt,
			'position' => $position
		);

		return $image;
	}



}