jQuery(document).ready(function(a){a(".ei-slider").each(function(){var t=a(this);a(t).eislideshow({animation:t.data("animation"),autoplay:t.data("autoplay"),slideshow_interval:t.data("interval"),easing:t.data("easing"),titlespeed:t.data("titlespeed"),titleeasing:t.data("titleeasing"),thumbMaxWidth:t.data("thumb")})})});