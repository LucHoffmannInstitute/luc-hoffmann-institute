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

	// get options
	this.opts = this.getOpts();

	// build DOM template
	this.tmpl = this.buildTmpl();

	console.log(this.tmpl);
};

/**
 * Get options
 */
Select.prototype.getOpts = function () {
	var opts = [];

	$.each(this.$el.find('option'), function () {
		opts.push($(this).val());
	});

	return opts;
};

/**
 * Build DOM template
 */
Select.prototype.buildTmpl = function () {
	var tmpl = $('<ul>');

	// add classes
	tmpl.addClass(this.selectClass);

	// add options
	$.each(this.opts, function () {
		tmpl.append('<li>''</li>');
	});

	return tmpl;
};

module.exports = new Select();