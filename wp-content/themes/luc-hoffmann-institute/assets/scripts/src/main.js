'use strict';

var handshake = require('./modules/handshake');
var profiles = require('./modules/profiles');
var fitvids = require('../../../bower_components/fitvids/jquery.fitvids');

handshake.init();
profiles.init();

/**
 * FitVids: responsive video embeds
 */
$('.entry').fitVids();