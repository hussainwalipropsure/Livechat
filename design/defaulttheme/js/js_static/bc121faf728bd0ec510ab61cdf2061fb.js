lhcAppControllers.controller("CannedReplaceCtrl",["$scope","$http","$location","$rootScope","$log","$window",function(n,e,t,i,o,d){this.combinations=[],this.departments=[];var s=this;this.makeid=function(n){for(var e="",t="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",i=0;i<n;i++)e+=t.charAt(Math.floor(Math.random()*t.length));return e},this.setConditions=function(){this.combinations=d.replaceConditions,this.departments=d.replaceDepartments},this.deleteElement=function(n,e){confirm("Are you sure?")&&e.splice(e.indexOf(n),1)},this.addOption=function(n){this.addDepartment(n)},this.move=function(n,e,t){index=e.indexOf(n),newIndex=index+t,newIndex>-1&&newIndex<e.length&&(removedElement=e.splice(index,1)[0],e.splice(newIndex,0,removedElement))},this.addCombination=function(){s.combinations.push({conditions:[],value:"",dep_id:"0",dep_ids:[],priority:0}),setTimeout((function(){$(".btn-block-department").makeDropdown()}),1e3)},this.addDepartment=function(n){n.dep_ids||(n.dep_ids=[]),-1==n.dep_ids.indexOf(n.dep_id)&&n.dep_ids.push(n.dep_id)},this.addCondition=function(n){n.conditions.push({field:"",logic:"and"})},this.moveUp=function(n,e){s.move(n,e,-1)},this.moveDown=function(n,e){s.move(n,e,1)},setTimeout((function(){$(".btn-block-department").makeDropdown()}),1500)}]);
//# sourceMappingURL=bc121faf728bd0ec510ab61cdf2061fb.js.map