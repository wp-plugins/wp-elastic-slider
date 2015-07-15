jQuery(document).ready(function(){!function(i,t){var s,e=t.event;e.special.smartresize={setup:function(){t(this).bind("resize",e.special.smartresize.handler)},teardown:function(){t(this).unbind("resize",e.special.smartresize.handler)},handler:function(i,t){var e=this,n=arguments;i.type="smartresize",s&&clearTimeout(s),s=setTimeout(function(){jQuery.event.handle.apply(e,n)},"execAsap"===t?0:100)}},t.fn.smartresize=function(i){return i?this.bind("smartresize",i):this.trigger("smartresize",["execAsap"])},t.Slideshow=function(i,s){this.$el=t(s),this.$list=this.$el.find("ul.ei-slider-large"),this.$imgItems=this.$list.children("li"),this.itemsCount=this.$imgItems.length,this.$images=this.$imgItems.find("img:first"),this.$sliderthumbs=this.$el.find("ul.ei-slider-thumbs").hide(),this.$sliderElems=this.$sliderthumbs.children("li"),this.$sliderElem=this.$sliderthumbs.children("li.ei-slider-element"),this.$thumbs=this.$sliderElems.not(".ei-slider-element"),this._init(i)},t.Slideshow.defaults={animation:"sides",autoplay:!1,slideshow_interval:3e3,speed:800,easing:"",titlesFactor:.6,titlespeed:800,titleeasing:"",thumbMaxWidth:150},t.Slideshow.prototype={_init:function(i){this.options=t.extend(!0,{},t.Slideshow.defaults,i),this.$imgItems.css("opacity",0),this.$imgItems.find("div.ei-title > *").css("opacity",0),this.current=0;var s=this;this.$loading=t('<div class="ei-slider-loading">Loading</div>').prependTo(s.$el),t.when(this._preloadImages()).done(function(){s.$loading.hide(),s._setImagesSize(),s._initThumbs(),s.$imgItems.eq(s.current).css({opacity:1,"z-index":10}).show().find("div.ei-title > *").css("opacity",1),s.options.autoplay&&s._startSlideshow(),s._initEvents()})},_preloadImages:function(){var i=this,s=0;return t.Deferred(function(e){i.$images.each(function(){t("<img/>").load(function(){++s===i.itemsCount&&e.resolve()}).attr("src",t(this).attr("src"))})}).promise()},_setImagesSize:function(){this.elWidth=this.$el.width();var i=this;this.$images.each(function(){var s=t(this);imgDim=i._getImageDim(s.attr("src")),s.css({width:imgDim.width,height:imgDim.height,marginLeft:imgDim.left,marginTop:imgDim.top})})},_getImageDim:function(i){var t=new Image;t.src=i;var s,e,n=this.elWidth,o=this.$el.height(),h=o/n,a=t.width,r=t.height,l=r/a;return h>l?(e=o,s=o/l):(e=n*l,s=n),{width:s,height:e,left:(n-s)/2,top:(o-e)/2}},_initThumbs:function(){this.$sliderElems.css({"max-width":this.options.thumbMaxWidth+"px",width:100/this.itemsCount+"%"}),this.$sliderthumbs.css("max-width",this.options.thumbMaxWidth*this.itemsCount+"px").show()},_startSlideshow:function(){var i=this;this.slideshow=setTimeout(function(){var t;t=i.current===i.itemsCount-1?0:i.current+1,i._slideTo(t),i.options.autoplay&&i._startSlideshow()},this.options.slideshow_interval)},_slideTo:function(i){if(i===this.current||this.isAnimating)return!1;this.isAnimating=!0;var s=this.$imgItems.eq(this.current),e=this.$imgItems.eq(i),n=this,o={zIndex:10},h={opacity:1};"sides"===this.options.animation&&(o.left=i>this.current?-1*this.elWidth:this.elWidth,h.left=0),e.find("div.ei-title > h2").css("margin-right","50px").stop().delay(this.options.speed*this.options.titlesFactor).animate({marginRight:"0px",opacity:1},this.options.titlespeed,this.options.titleeasing).end().find("div.ei-title > h3").css("margin-right","-50px").stop().delay(this.options.speed*this.options.titlesFactor).animate({marginRight:"0px",opacity:1},this.options.titlespeed,this.options.titleeasing),t.when(s.css("z-index",1).find("div.ei-title > *").stop().fadeOut(this.options.speed/2,function(){t(this).show().css("opacity",0)}),e.css(o).stop().animate(h,this.options.speed,this.options.easing),this.$sliderElem.stop().animate({left:this.$thumbs.eq(i).position().left},this.options.speed)).done(function(){s.css("opacity",0).find("div.ei-title > *").css("opacity",0),n.current=i,n.isAnimating=!1})},_initEvents:function(){var s=this;t(i).on("smartresize.eislideshow",function(){s._setImagesSize(),s.$sliderElem.css("left",s.$thumbs.eq(s.current).position().left)}),this.$thumbs.on("click.eislideshow",function(){s.options.autoplay&&(clearTimeout(s.slideshow),s.options.autoplay=!1);var i=t(this),e=i.index()-1;return s._slideTo(e),!1})}};var n=function(i){this.console&&console.error(i)};t.fn.eislideshow=function(i){if("string"==typeof i){var s=Array.prototype.slice.call(arguments,1);this.each(function(){var e=t.data(this,"eislideshow");return e?t.isFunction(e[i])&&"_"!==i.charAt(0)?void e[i].apply(e,s):void n("no such method '"+i+"' for eislideshow instance"):void n("cannot call methods on eislideshow prior to initialization; attempted to call method '"+i+"'")})}else this.each(function(){var s=t.data(this,"eislideshow");s||t.data(this,"eislideshow",new t.Slideshow(i,this))});return this}}(window,jQuery);});