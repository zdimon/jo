function Dklab_Realplexor(fullUrl,namespace,viaDocumentWrite)
{var VERSION="1.32";var host=document.location.host;if(!this.constructor._registry)this.constructor._registry={};this.version=VERSION;this._map={};this._realplexor=null;this._namespace=namespace;this._login=null;this._iframeId="mpl"+(new Date().getTime());this._iframeTag='<iframe'+' id="'+this._iframeId+'"'+' onload="'+'Dklab_Realplexor'+'._iframeLoaded(&quot;'+this._iframeId+'&quot;)"'+' src="'+fullUrl+'?identifier=IFRAME&amp;HOST='+host+'&amp;version='+this.version+'"'+' style="position:absolute; visibility:hidden; width:200px; height:200px; left:-1000px; top:-1000px"'+'></iframe>';this._iframeCreated=false;this._needExecute=false;this._executeTimer=null;this.constructor._registry[this._iframeId]=this;if(!fullUrl.match(/^\w+:\/\/([^/]+)/)){throw'Dklab_Realplexor constructor argument must be fully-qualified URL, '+fullUrl+' given.';}
var mHost=RegExp.$1;if(mHost!=host&&mHost.lastIndexOf("."+host)!=mHost.length-host.length-1){throw'Due to the standard XMLHttpRequest security policy, hostname in URL passed to Dklab_Realplexor ('+mHost+') must be equals to the current host ('+host+') or be its direct sub-domain.';}
if(viaDocumentWrite){document.write(this._iframeTag);this._iframeCreated=true;}
document.domain=host;}
Dklab_Realplexor._iframeLoaded=function(id)
{var th=this._registry[id];setTimeout(function(){var iframe=document.getElementById(id);th._realplexor=iframe.contentWindow.Dklab_Realplexor_Loader;if(th.needExecute){th.execute();}},50);}
Dklab_Realplexor.prototype.logon=function(login){this._login=login;}
Dklab_Realplexor.prototype.setCursor=function(id,cursor){if(!this._map[id])this._map[id]={cursor:null,callbacks:[]};this._map[id].cursor=cursor;return this;}
Dklab_Realplexor.prototype.subscribe=function(id,callback){if(!this._map[id])this._map[id]={cursor:null,callbacks:[]};var chain=this._map[id].callbacks;for(var i=0;i<chain.length;i++){if(chain[i]===callback)return this;}
chain.push(callback);return this;}
Dklab_Realplexor.prototype.unsubscribe=function(id,callback){if(!this._map[id])return this;if(callback==null){this._map[id].callbacks=[];return this;}
var chain=this._map[id].callbacks;for(var i=0;i<chain.length;i++){if(chain[i]===callback){chain.splice(i,1);return this;}}
return this;}
Dklab_Realplexor.prototype.execute=function(){if(!this._iframeCreated){var div=document.createElement('DIV');div.innerHTML=this._iframeTag;document.body.appendChild(div);this._iframeCreated=true;}
if(this._executeTimer){clearTimeout(this._executeTimer);this._executeTimer=null;}
var th=this;if(!this._realplexor){this._executeTimer=setTimeout(function(){th.execute()},30);return;}
this._realplexor.execute(this._map,this.constructor._callAndReturnException,(this._login!=null?this._login+"_":"")+(this._namespace!=null?this._namespace:""));}
Dklab_Realplexor._callAndReturnException=function(func,args){try{func.apply(null,args);return null;}catch(e){return""+e;}}