'use strict';

var handshake = require('./modules/handshake');
var profiles = require('./modules/profiles');
var tabs = require('./modules/tabs');
var fitvids = require('../../../bower_components/fitvids/jquery.fitvids');
//var select = require('./modules/select');

handshake.init();
profiles.init();
tabs.init();

/**
 * FitVids: responsive video embeds
 */
$('.Entry').fitVids();