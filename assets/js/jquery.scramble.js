/*
 * Copyright © 2013 daniel g. siegel <daniel@dgsiegel.net>
 *
 * jQuery scramble plugin
 * A jQuery plugin using the fisher yates shuffle algorithm
 * for scrambling a set of elements
 * http://en.wikipedia.org/wiki/Fisher-Yates_shuffle
 *
 * Usage: $(selector).scramble();
 *
 * v1.0.0 - 20/03/2013
 *
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.
*/

(function($){
  $.fn.scramble = function() {
    var len = this.length;
    if (len > 0) {
      var i;
      var tmp;
      while (--len) {
        i = Math.floor(Math.random() * (len + 1));
        tmp = this[i];
        this[i] = this[len];
        this[len] = tmp;
      }
    }
    return this;
  };
})(jQuery);
