import {isVisible} from "bootstrap/js/src/util";

require('./bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';
$('.datepicker').datepicker();
