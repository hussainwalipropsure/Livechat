"use strict";(self.webpackChunkLiveHelperChat=self.webpackChunkLiveHelperChat||[]).push([[530],{2530:function(t,i,e){e.r(i),e.d(i,{proactiveChat:function(){return r}});var n=e(5671),s=e(3144),a=e(2137),o=e(593),r=new(function(){function t(){(0,n.Z)(this,t),this.params={},this.timeoutStatuscheck=null,this.timeoutActivity=null,this.attributes=null,this.chatEvents=null,this.dynamicInvitations=[],this.iddleTimeoutActivity=null,this.checkMessageTimeout=null,this.nextRescheduleTimeout=null,this.initCall=!0,this.inProgress=!1}return(0,s.Z)(t,[{key:"setParams",value:function(t,i,e){var n=this;this.params=t,this.attributes=i,this.chatEvents=e,this.attributes.events.length>0?this.storeEvents(this.attributes.events):this.initInvitation(),this.attributes.eventEmitter.addListener("tagAdded",(function(){n.initInvitation({init:0})})),this.attributes.eventEmitter.addListener("eventAdded",(function(){n.storeEvents(n.attributes.events)})),this.attributes.eventEmitter.addListener("checkMessageOperator",(function(){n.initInvitation({init:0})})),this.attributes.eventEmitter.addListener("endChat",(function(){n.initInvitation({init:0})})),this.attributes.onlineStatus.subscribe((function(t){1==t?n.initInvitation({init:0}):!n.attributes.userSession.getSessionAttributes().id&&n.attributes.proactive.invitation&&(n.attributes.proactive={},!1!==n.attributes.mainWidget.isLoaded&&n.chatEvents.sendChildEvent("proactive",[{}]),n.attributes.mainWidget.hideInvitation(),n.attributes.eventEmitter.emitEvent("closeWidget",[{sender:"closeButton"}]))}))}},{key:"showInvitation",value:function(t,i){var e=this.attributes.userSession.getSessionAttributes();if(!(0===i&&!0===this.attributes.widgetStatus.value&&"embed"==!this.attributes.mode||e.id)){if(t.inject_html&&t.invitation){var n=document.getElementsByTagName("head")[0],s=document.createElement("script");s.setAttribute("type","text/javascript"),s.setAttribute("src",this.attributes.LHC_API.args.lhc_base_url+this.attributes.lang+"chat/htmlsnippet/"+t.invitation+"/inv/0/?ts="+Date.now()),n.appendChild(s)}t.only_inject||(this.attributes.proactive=t,!1===this.attributes.mainWidget.isLoaded?this.attributes.mainWidget.bootstrap():this.chatEvents.sendChildEvent("proactive",[t]),clearTimeout(this.checkMessageTimeout),clearTimeout(this.nextRescheduleTimeout))}}},{key:"storeEvents",value:function(t){var i=this;this.attributes.userSession.getSessionAttributes().id||1!=this.attributes.onlineStatus.value||a.a.makeRequest(this.attributes.LHC_API.args.lhc_base_url+this.attributes.lang+"chat/logevent/(vid)/"+this.attributes.userSession.getVID(),{params:{data:JSON.stringify(t)}},(function(t){i.initInvitation({init:0})}))}},{key:"initInvitation",value:function(t){var i=this;if(1!=this.inProgress){clearTimeout(this.checkMessageTimeout);var e=this.attributes.userSession.getSessionAttributes(),n=t&&0===t.init?0:1;if(!e.id&&1==this.attributes.onlineStatus.value){this.inProgress=!0;var s={vid:this.attributes.userSession.getVID(),dep:this.attributes.department.join(",")};this.attributes.LHC_API.args.priority&&(s.priority=this.attributes.LHC_API.args.priority),this.attributes.LHC_API.args.operator&&(s.operator=this.attributes.LHC_API.args.operator),this.attributes.identifier&&(s.idnt=this.attributes.identifier),this.attributes.tag&&(s.tag=this.attributes.tag),this.attributes.langOverride&&(s.lang=this.attributes.langOverride),s.l=encodeURIComponent(window.location.href.substring(window.location.protocol.length)),s.dt=encodeURIComponent(document.title),s.init=1==this.initCall?1:n,this.initCall=!1,a.a.makeRequest(this.attributes.LHC_API.args.lhc_base_url+this.attributes.lang+"widgetrestapi/checkinvitation",{params:s},(function(t){if(i.inProgress=!1,t.invitation){var e={vid_id:t.vid_id,invitation:t.invitation,inject_html:t.inject_html,qinv:t.qinv};setTimeout((function(){i.showInvitation(e,n)}),!0===i.attributes.widgetStatus.value?0:t.delay||0)}else i.attributes.LHC_API.args.check_messages&&(i.checkMessageTimeout=setTimeout((function(){i.initInvitation({init:0})}),1e3*i.params.interval));t.next_reschedule&&(i.nextRescheduleTimeout=setTimeout((function(){i.initInvitation({init:0})}),t.next_reschedule)),t.dynamic&&t.dynamic.forEach((function(e){i.dynamicInvitations.push(e.id),1===e.type?o.U.listen(document,"mouseout",(function(n){var s=(n=n||window.event).relatedTarget||n.toElement;s&&"HTML"!=s.nodeName||(i.showInvitation({vid_id:t.vid_id,invitation:e.id,inject_html:e.inject_html,qinv:t.qinv,only_inject:e.only_inject}),e.every_time||o.U.unlisten("lhc_inv_mouse_out_"+e.id))}),"lhc_inv_mouse_out_"+e.id):2===e.type&&(i.iddleTimeoutActivityReset=function(){clearTimeout(i.iddleTimeoutActivity),i.iddleTimeoutActivity=setTimeout((function(){i.showInvitation({vid_id:t.vid_id,invitation:e.id,inject_html:e.inject_html,qinv:t.qinv,only_inject:e.only_inject}),clearTimeout(i.iddleTimeoutActivity),e.every_time||(["mousemove","mousedown","click","scroll","keypress","load"].forEach((function(t){o.U.unlisten("lhc_inv_iddl_win_"+t)})),["mousemove","scroll","touchstart","touchend"].forEach((function(t){o.U.unlisten("lhc_inv_iddl_doc_"+t)})))}),1e3*e.iddle_for)},i.iddleTimeoutActivityReset(),["mousemove","mousedown","click","scroll","keypress","load"].forEach((function(t){o.U.listen(window,t,i.iddleTimeoutActivityReset,"lhc_inv_iddl_win_"+t)})),["mousemove","scroll","touchstart","touchend"].forEach((function(t){o.U.listen(document,t,i.iddleTimeoutActivityReset,"lhc_inv_iddl_doc_"+t)})))}))}))}}}}]),t}())}}]);
//# sourceMappingURL=829b4eca4cecbec9ef1f.js.map