<?php

use SilverStripe\View\ViewableData;
use SilverStripe\View\Requirements;
use SilverStripe\Core\Convert;

class CalendarWidget extends ViewableData {
	
	protected $calendar;

	protected $selectionStart;

	protected $selectionEnd;

	protected $options = array ();

	public function __construct(Calendar $calendar) {
		$this->calendar = $calendar;
	}

	public function setOption($k, $v) {
		$this->options[$k] = $v;
	}
	
	public function getDataAttributes() {
		$attributes = "";
		$this->options['url'] = $this->calendar->Link();

		foreach($this->options as $opt => $value) {
			$attributes .= sprintf('data-%s="%s" ', $opt, Convert::raw2att($value));
		}
		
		return $attributes;
	}

	public function setSelectionStart($date) {
		$this->selectionStart = $date;
	}

	public function setSelectionEnd($date) {
		$this->selectionEnd = $date;
	}

	public function forTemplate() {
        if(!Calendar::config()->get('jquery_included')) {
            Requirements::javascript('silverstripe/admin: thirdparty/jquery/jquery.js');
        }	
		Requirements::javascript("event_calendar/javascript/calendar_widget.js");
		$locale_file = _t('Calendar.DATEJSFILE','calendar_en.js');
		Requirements::javascript($this->ThemeDir() . "/javascript/lang/{$locale_file}");
		Requirements::javascript("event_calendar/javascript/calendar_widget_init.js");
		Requirements::css("event_calendar/css/calendar_widget.css");
		return '<div class="calendar-widget" ' . $this->getDataAttributes() . '></div>';
	}
}
