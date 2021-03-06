/**
 * v0.3 THFloat plugin for jQuery
 * http://rommelsantor.com/jquery/thfloat
 *
 * Author(s): Rommel Santor
 *            http://rommelsantor.com
 *
 * This plugin allows you to float a table's <thead> or <tfoot> keeping it
 * in view when it would normally be scrolled out of view.
 *
 * Copyright (c) 2011 by Rommel Santor <rommel at rommelsantor dot com>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
(function($){jQuery.fn.css2=jQuery.fn.css;jQuery.fn.css=function(){if(arguments.length)return jQuery.fn.css2.apply(this,arguments);var attr=['font-family','font-size','font-weight','font-style','color','text-transform','text-decoration','letter-spacing','word-spacing','line-height','text-align','vertical-align','direction','background-color','background-image','background-repeat','background-position','background-attachment','opacity','width','height','top','right','bottom','left','margin-top','margin-right','margin-bottom','margin-left','padding-top','padding-right','padding-bottom','padding-left','border-top-width','border-right-width','border-bottom-width','border-left-width','border-top-color','border-right-color','border-bottom-color','border-left-color','border-top-style','border-right-style','border-bottom-style','border-left-style','position','display','visibility','z-index','overflow-x','overflow-y','white-space','clip','float','clear','cursor','list-style-image','list-style-position','list-style-type','marker-offset'];var len=attr.length,obj={};for(var i=0;i<len;i++)
obj[attr[i]]=jQuery.fn.css2.call(this,attr[i]);return obj;}
var methods={init:function(options){var settings={side:'head',attachment:window,sticky:false,onShow:function(table,block){},onHide:function(table,block){}};if(typeof options==='object')
$.extend(settings,options);var $this=this,side=settings.side=='foot'?'foot':'head',other=side=='foot'?'head':'foot',ns='thfloat'+side,data=$this.data(ns);while(!data){var $src=$("t"+side,this),$opp=$("t"+other,this);if(!$src.length)
break;data={settings:settings,active:false,clonetbl:$(this).clone(true).attr({id:ns+($this.attr('id')?('-'+$this.attr('id')):'')}).addClass('thfloat-table').css({zIndex:'1000',display:'none',position:'absolute'}).appendTo('body'),srcblock:$src,oppblock:$opp.length?$opp:null,thwidths:[],cloneblk:null};data.clonetbl.children().remove();$this.data(ns,data);$(window).bind('resize.'+ns,function(){$.each(['thfloathead','thfloatfoot'],function(i,ns){var data=$this.data(ns);if(!data)
return;var thw=[];$("tr",data.srcblock).children().each(function(){thw.push($(this).width());});data.thwidths=thw;$this.data(ns,data);$this.thfloat('_scroll',ns,$(data.settings.attachment));});}).resize();var a=$(settings.attachment).bind('scroll.'+ns,function(){$this.thfloat('_scroll',ns,this);});$this.thfloat('_scroll',ns,a);break;}
return $this;},refresh:function(side){var $this=$(this);$.each(['head','foot'],function(i,s){if(side&&side!=s)
return;var ns='thfloat'+s,data=$this.data(ns);if(data)
$this.thfloat('_scroll',ns,data.settings.attachment);});},resize:function(side){var $this=$(this);$.each(['head','foot'],function(i,s){if(side&&side!=s)
return;var ns='thfloat'+s,data=$this.data(ns);if(!data||!data.active)
return;var thw=[];$("tr",data.srcblock).children().each(function(){thw.push($(this).width());});var $el=$(data.settings.attachment),heightOffset=$.browser.mozilla||$.browser.opera||$.browser.msie?-(($this.attr('cellspacing')||0)*2):0,edgeheight=s=='foot'?((!$el.offset()?$el.height():$el.innerHeight())-data.srcblock.outerHeight()+heightOffset):0,edge=!$el.offset()?($el.scrollTop()+edgeheight):($el.offset().top+edgeheight);data.clonetbl.css({top:edge+'px',left:$this.offset().left+"px",width:$this.width()+'px'});$('tr',data.cloneblk).children().each(function(i){$(this).css({width:thw[i]+'px',maxWidth:thw[i]+'px'});});data.thwidths=thw;$this.data(ns,data);});},destroy:function(side){var $this=this;$.each(['thfloathead','thfloatfoot'],function(i,ns){var data=$this.data(ns);if(!data||(side&&('thfloat'+side)!=ns))
return;$(data.settings.attachment).unbind('.'+ns);$(window).unbind('.'+ns);data.clonetbl.remove();data.cloneblk&&data.cloneblk.remove();$this.removeData(ns);});return $this;},_scroll:function(ns,element){var $this=this,$el=$(element);var data=$this.data(ns);if(!data)
return;var heightOffset=$.browser.mozilla||$.browser.opera||$.browser.msie?-(($this.attr('cellspacing')||0)*2):0,edgeheight=data.settings.side=='foot'?((!$el.offset()?$el.height():$el.innerHeight())-data.srcblock.outerHeight()+heightOffset):0,edge=!$el.offset()?($el.scrollTop()+edgeheight):($el.offset().top+edgeheight),beyond=data.settings.side=='foot'?((!data.settings.sticky&&data.srcblock.offset().top<edge)||(!data.oppblock?false:(data.oppblock.offset().top+data.oppblock.outerHeight()>=edge))):((!data.settings.sticky&&data.srcblock.offset().top>edge)||(!data.oppblock?false:(data.oppblock.offset().top<=edge+data.srcblock.outerHeight())));if(!data.active){if(!beyond){data.active=true;data.clonetbl.css({display:($this.is(':visible')?'table':'none'),top:edge+'px',left:$this.offset().left+"px",marginTop:'0',marginBottom:'0',width:$this.width()+'px'});data.cloneblk=data.srcblock.clone(true);data.cloneblk.addClass('thfloat');data.cloneblk.css(data.srcblock.css());data.cloneblk.children().remove();$("tr",data.srcblock).each(function(){var tr=$(this).clone(true).css($(this).css());tr.children().remove();$("td,th",this).each(function(){tr.append($(this).clone(true).css($(this).css()));});data.cloneblk.append(tr);});data.cloneblk.appendTo(data.clonetbl);$this.thfloat('resize',data.settings.side);data.settings.onShow&&data.settings.onShow.apply(this,[data.clonetbl,data.cloneblk]);}}
else{if(data.clonetbl.is(':visible')!=$this.is(':visible'))
data.clonetbl.css({display:($this.is(':visible')?'table':'none')});if(beyond){data.settings.onHide&&data.settings.onHide.apply(this,[data.clonetbl,data.cloneblk]);data.active=false;data.cloneblk.remove();data.cloneblk=null;data.clonetbl.css({display:'none'});}
else
$this.thfloat('resize',data.settings.side);}
$this.data(ns,data);}};$.fn.thfloat=function(method){if(methods[method])
return methods[method].apply(this,Array.prototype.slice.call(arguments,1));else if(typeof method==='object'||!method)
return methods.init.apply(this,arguments);else
$.error('Method '+method+' does not exist on jQuery.thfloat');};})(jQuery);