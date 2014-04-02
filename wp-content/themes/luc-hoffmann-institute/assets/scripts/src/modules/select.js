'use strict';

var Select = function () {
	var _this = this;

	// Make a chainable jQuery plugin
	return $.each($('.' + this.selectClass), function () {
		_this.init($(this));
	});
};

Select.prototype = {
	selectClass: 'Select'
};

/**
 * Intialization
 */
Select.prototype.init = function ($el) {
	this.$el = $el;
	this.$form = this.$el.parents('form');

	// interactions
	this.interactions();
};

/**
 * Interactions
 */
Select.prototype.interactions = function () {
	var _this = this;

	this.$el.on('change', function () {
		_this.$form.submit();
	});
};

module.exports = new Select();