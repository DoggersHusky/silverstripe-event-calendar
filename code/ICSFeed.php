<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;

class ICSFeed extends DataObject {
	
	private static $db = [
		'Title' => 'Varchar(100)',
		'URL' => 'Varchar(255)'
	];

	private static $has_one = [
		'Calendar' => 'Calendar'
	];

	public function getCMSFields() {
		$f = new FieldList (
			new TextField('Title',_t('ICSFeed.TITLEOFFEED','Title of feed')),
			new TextField('URL',_t('ICSFeed.URLLINK','URL'),'http://')
		);

		$this->extend('updateCMSFields', $f);

		return $f;
	}
	
	public function summaryFields() {
		return array (
				'Title' => _t('ICSFeed.TITLE','Title'),
		);
	}	
}
