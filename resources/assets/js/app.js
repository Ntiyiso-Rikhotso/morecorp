

require('./plugins/popper.min');
require('./bootstrap');
require('./plugins/holder.min');

const Overlay  = require('gasparesganga-jquery-loading-overlay');
const feather  = require('feather-icons');

require('./plugins/dashboard/Chart.min.js');
require('./custom');
feather.replace();