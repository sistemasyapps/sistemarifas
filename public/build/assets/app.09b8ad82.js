function Kt(e,t){return function(){return e.apply(t,arguments)}}const{toString:Zn}=Object.prototype,{getPrototypeOf:Ye}=Object,{iterator:pe,toStringTag:zt}=Symbol,me=(e=>t=>{const n=Zn.call(t);return e[n]||(e[n]=n.slice(8,-1).toLowerCase())})(Object.create(null)),D=e=>(e=e.toLowerCase(),t=>me(t)===e),ge=e=>t=>typeof t===e,{isArray:W}=Array,Y=ge("undefined");function te(e){return e!==null&&!Y(e)&&e.constructor!==null&&!Y(e.constructor)&&C(e.constructor.isBuffer)&&e.constructor.isBuffer(e)}const Wt=D("ArrayBuffer");function Qn(e){let t;return typeof ArrayBuffer<"u"&&ArrayBuffer.isView?t=ArrayBuffer.isView(e):t=e&&e.buffer&&Wt(e.buffer),t}const er=ge("string"),C=ge("function"),Jt=ge("number"),ne=e=>e!==null&&typeof e=="object",tr=e=>e===!0||e===!1,oe=e=>{if(me(e)!=="object")return!1;const t=Ye(e);return(t===null||t===Object.prototype||Object.getPrototypeOf(t)===null)&&!(zt in e)&&!(pe in e)},nr=e=>{if(!ne(e)||te(e))return!1;try{return Object.keys(e).length===0&&Object.getPrototypeOf(e)===Object.prototype}catch{return!1}},rr=D("Date"),sr=D("File"),or=D("Blob"),ir=D("FileList"),ar=e=>ne(e)&&C(e.pipe),cr=e=>{let t;return e&&(typeof FormData=="function"&&e instanceof FormData||C(e.append)&&((t=me(e))==="formdata"||t==="object"&&C(e.toString)&&e.toString()==="[object FormData]"))},ur=D("URLSearchParams"),[lr,fr,dr,hr]=["ReadableStream","Request","Response","Headers"].map(D),pr=e=>e.trim?e.trim():e.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,"");function re(e,t,{allOwnKeys:n=!1}={}){if(e===null||typeof e>"u")return;let r,s;if(typeof e!="object"&&(e=[e]),W(e))for(r=0,s=e.length;r<s;r++)t.call(null,e[r],r,e);else{if(te(e))return;const o=n?Object.getOwnPropertyNames(e):Object.keys(e),i=o.length;let a;for(r=0;r<i;r++)a=o[r],t.call(null,e[a],a,e)}}function Gt(e,t){if(te(e))return null;t=t.toLowerCase();const n=Object.keys(e);let r=n.length,s;for(;r-- >0;)if(s=n[r],t===s.toLowerCase())return s;return null}const j=(()=>typeof globalThis<"u"?globalThis:typeof self<"u"?self:typeof window<"u"?window:global)(),Xt=e=>!Y(e)&&e!==j;function Le(){const{caseless:e}=Xt(this)&&this||{},t={},n=(r,s)=>{const o=e&&Gt(t,s)||s;oe(t[o])&&oe(r)?t[o]=Le(t[o],r):oe(r)?t[o]=Le({},r):W(r)?t[o]=r.slice():t[o]=r};for(let r=0,s=arguments.length;r<s;r++)arguments[r]&&re(arguments[r],n);return t}const mr=(e,t,n,{allOwnKeys:r}={})=>(re(t,(s,o)=>{n&&C(s)?e[o]=Kt(s,n):e[o]=s},{allOwnKeys:r}),e),gr=e=>(e.charCodeAt(0)===65279&&(e=e.slice(1)),e),br=(e,t,n,r)=>{e.prototype=Object.create(t.prototype,r),e.prototype.constructor=e,Object.defineProperty(e,"super",{value:t.prototype}),n&&Object.assign(e.prototype,n)},wr=(e,t,n,r)=>{let s,o,i;const a={};if(t=t||{},e==null)return t;do{for(s=Object.getOwnPropertyNames(e),o=s.length;o-- >0;)i=s[o],(!r||r(i,e,t))&&!a[i]&&(t[i]=e[i],a[i]=!0);e=n!==!1&&Ye(e)}while(e&&(!n||n(e,t))&&e!==Object.prototype);return t},yr=(e,t,n)=>{e=String(e),(n===void 0||n>e.length)&&(n=e.length),n-=t.length;const r=e.indexOf(t,n);return r!==-1&&r===n},Er=e=>{if(!e)return null;if(W(e))return e;let t=e.length;if(!Jt(t))return null;const n=new Array(t);for(;t-- >0;)n[t]=e[t];return n},Sr=(e=>t=>e&&t instanceof e)(typeof Uint8Array<"u"&&Ye(Uint8Array)),Tr=(e,t)=>{const r=(e&&e[pe]).call(e);let s;for(;(s=r.next())&&!s.done;){const o=s.value;t.call(e,o[0],o[1])}},Ar=(e,t)=>{let n;const r=[];for(;(n=e.exec(t))!==null;)r.push(n);return r},_r=D("HTMLFormElement"),Ir=e=>e.toLowerCase().replace(/[-_\s]([a-z\d])(\w*)/g,function(n,r,s){return r.toUpperCase()+s}),pt=(({hasOwnProperty:e})=>(t,n)=>e.call(t,n))(Object.prototype),Rr=D("RegExp"),Yt=(e,t)=>{const n=Object.getOwnPropertyDescriptors(e),r={};re(n,(s,o)=>{let i;(i=t(s,o,e))!==!1&&(r[o]=i||s)}),Object.defineProperties(e,r)},Cr=e=>{Yt(e,(t,n)=>{if(C(e)&&["arguments","caller","callee"].indexOf(n)!==-1)return!1;const r=e[n];if(!!C(r)){if(t.enumerable=!1,"writable"in t){t.writable=!1;return}t.set||(t.set=()=>{throw Error("Can not rewrite read-only method '"+n+"'")})}})},Or=(e,t)=>{const n={},r=s=>{s.forEach(o=>{n[o]=!0})};return W(e)?r(e):r(String(e).split(t)),n},Dr=()=>{},kr=(e,t)=>e!=null&&Number.isFinite(e=+e)?e:t;function Nr(e){return!!(e&&C(e.append)&&e[zt]==="FormData"&&e[pe])}const vr=e=>{const t=new Array(10),n=(r,s)=>{if(ne(r)){if(t.indexOf(r)>=0)return;if(te(r))return r;if(!("toJSON"in r)){t[s]=r;const o=W(r)?[]:{};return re(r,(i,a)=>{const f=n(i,s+1);!Y(f)&&(o[a]=f)}),t[s]=void 0,o}}return r};return n(e,0)},Pr=D("AsyncFunction"),Br=e=>e&&(ne(e)||C(e))&&C(e.then)&&C(e.catch),Zt=((e,t)=>e?setImmediate:t?((n,r)=>(j.addEventListener("message",({source:s,data:o})=>{s===j&&o===n&&r.length&&r.shift()()},!1),s=>{r.push(s),j.postMessage(n,"*")}))(`axios@${Math.random()}`,[]):n=>setTimeout(n))(typeof setImmediate=="function",C(j.postMessage)),xr=typeof queueMicrotask<"u"?queueMicrotask.bind(j):typeof process<"u"&&process.nextTick||Zt,Fr=e=>e!=null&&C(e[pe]),c={isArray:W,isArrayBuffer:Wt,isBuffer:te,isFormData:cr,isArrayBufferView:Qn,isString:er,isNumber:Jt,isBoolean:tr,isObject:ne,isPlainObject:oe,isEmptyObject:nr,isReadableStream:lr,isRequest:fr,isResponse:dr,isHeaders:hr,isUndefined:Y,isDate:rr,isFile:sr,isBlob:or,isRegExp:Rr,isFunction:C,isStream:ar,isURLSearchParams:ur,isTypedArray:Sr,isFileList:ir,forEach:re,merge:Le,extend:mr,trim:pr,stripBOM:gr,inherits:br,toFlatObject:wr,kindOf:me,kindOfTest:D,endsWith:yr,toArray:Er,forEachEntry:Tr,matchAll:Ar,isHTMLForm:_r,hasOwnProperty:pt,hasOwnProp:pt,reduceDescriptors:Yt,freezeMethods:Cr,toObjectSet:Or,toCamelCase:Ir,noop:Dr,toFiniteNumber:kr,findKey:Gt,global:j,isContextDefined:Xt,isSpecCompliantForm:Nr,toJSONObject:vr,isAsyncFn:Pr,isThenable:Br,setImmediate:Zt,asap:xr,isIterable:Fr};function m(e,t,n,r,s){Error.call(this),Error.captureStackTrace?Error.captureStackTrace(this,this.constructor):this.stack=new Error().stack,this.message=e,this.name="AxiosError",t&&(this.code=t),n&&(this.config=n),r&&(this.request=r),s&&(this.response=s,this.status=s.status?s.status:null)}c.inherits(m,Error,{toJSON:function(){return{message:this.message,name:this.name,description:this.description,number:this.number,fileName:this.fileName,lineNumber:this.lineNumber,columnNumber:this.columnNumber,stack:this.stack,config:c.toJSONObject(this.config),code:this.code,status:this.status}}});const Qt=m.prototype,en={};["ERR_BAD_OPTION_VALUE","ERR_BAD_OPTION","ECONNABORTED","ETIMEDOUT","ERR_NETWORK","ERR_FR_TOO_MANY_REDIRECTS","ERR_DEPRECATED","ERR_BAD_RESPONSE","ERR_BAD_REQUEST","ERR_CANCELED","ERR_NOT_SUPPORT","ERR_INVALID_URL"].forEach(e=>{en[e]={value:e}});Object.defineProperties(m,en);Object.defineProperty(Qt,"isAxiosError",{value:!0});m.from=(e,t,n,r,s,o)=>{const i=Object.create(Qt);return c.toFlatObject(e,i,function(f){return f!==Error.prototype},a=>a!=="isAxiosError"),m.call(i,e.message,t,n,r,s),i.cause=e,i.name=e.name,o&&Object.assign(i,o),i};const Mr=null;function $e(e){return c.isPlainObject(e)||c.isArray(e)}function tn(e){return c.endsWith(e,"[]")?e.slice(0,-2):e}function mt(e,t,n){return e?e.concat(t).map(function(s,o){return s=tn(s),!n&&o?"["+s+"]":s}).join(n?".":""):t}function Lr(e){return c.isArray(e)&&!e.some($e)}const $r=c.toFlatObject(c,{},null,function(t){return/^is[A-Z]/.test(t)});function be(e,t,n){if(!c.isObject(e))throw new TypeError("target must be an object");t=t||new FormData,n=c.toFlatObject(n,{metaTokens:!0,dots:!1,indexes:!1},!1,function(g,p){return!c.isUndefined(p[g])});const r=n.metaTokens,s=n.visitor||u,o=n.dots,i=n.indexes,f=(n.Blob||typeof Blob<"u"&&Blob)&&c.isSpecCompliantForm(t);if(!c.isFunction(s))throw new TypeError("visitor must be a function");function l(h){if(h===null)return"";if(c.isDate(h))return h.toISOString();if(c.isBoolean(h))return h.toString();if(!f&&c.isBlob(h))throw new m("Blob is not supported. Use a Buffer instead.");return c.isArrayBuffer(h)||c.isTypedArray(h)?f&&typeof Blob=="function"?new Blob([h]):Buffer.from(h):h}function u(h,g,p){let E=h;if(h&&!p&&typeof h=="object"){if(c.endsWith(g,"{}"))g=r?g:g.slice(0,-2),h=JSON.stringify(h);else if(c.isArray(h)&&Lr(h)||(c.isFileList(h)||c.endsWith(g,"[]"))&&(E=c.toArray(h)))return g=tn(g),E.forEach(function(A,N){!(c.isUndefined(A)||A===null)&&t.append(i===!0?mt([g],N,o):i===null?g:g+"[]",l(A))}),!1}return $e(h)?!0:(t.append(mt(p,g,o),l(h)),!1)}const d=[],b=Object.assign($r,{defaultVisitor:u,convertValue:l,isVisitable:$e});function y(h,g){if(!c.isUndefined(h)){if(d.indexOf(h)!==-1)throw Error("Circular reference detected in "+g.join("."));d.push(h),c.forEach(h,function(E,T){(!(c.isUndefined(E)||E===null)&&s.call(t,E,c.isString(T)?T.trim():T,g,b))===!0&&y(E,g?g.concat(T):[T])}),d.pop()}}if(!c.isObject(e))throw new TypeError("data must be an object");return y(e),t}function gt(e){const t={"!":"%21","'":"%27","(":"%28",")":"%29","~":"%7E","%20":"+","%00":"\0"};return encodeURIComponent(e).replace(/[!'()~]|%20|%00/g,function(r){return t[r]})}function Ze(e,t){this._pairs=[],e&&be(e,this,t)}const nn=Ze.prototype;nn.append=function(t,n){this._pairs.push([t,n])};nn.toString=function(t){const n=t?function(r){return t.call(this,r,gt)}:gt;return this._pairs.map(function(s){return n(s[0])+"="+n(s[1])},"").join("&")};function Ur(e){return encodeURIComponent(e).replace(/%3A/gi,":").replace(/%24/g,"$").replace(/%2C/gi,",").replace(/%20/g,"+").replace(/%5B/gi,"[").replace(/%5D/gi,"]")}function rn(e,t,n){if(!t)return e;const r=n&&n.encode||Ur;c.isFunction(n)&&(n={serialize:n});const s=n&&n.serialize;let o;if(s?o=s(t,n):o=c.isURLSearchParams(t)?t.toString():new Ze(t,n).toString(r),o){const i=e.indexOf("#");i!==-1&&(e=e.slice(0,i)),e+=(e.indexOf("?")===-1?"?":"&")+o}return e}class jr{constructor(){this.handlers=[]}use(t,n,r){return this.handlers.push({fulfilled:t,rejected:n,synchronous:r?r.synchronous:!1,runWhen:r?r.runWhen:null}),this.handlers.length-1}eject(t){this.handlers[t]&&(this.handlers[t]=null)}clear(){this.handlers&&(this.handlers=[])}forEach(t){c.forEach(this.handlers,function(r){r!==null&&t(r)})}}const bt=jr,sn={silentJSONParsing:!0,forcedJSONParsing:!0,clarifyTimeoutError:!1},Hr=typeof URLSearchParams<"u"?URLSearchParams:Ze,qr=typeof FormData<"u"?FormData:null,Vr=typeof Blob<"u"?Blob:null,Kr={isBrowser:!0,classes:{URLSearchParams:Hr,FormData:qr,Blob:Vr},protocols:["http","https","file","blob","url","data"]},Qe=typeof window<"u"&&typeof document<"u",Ue=typeof navigator=="object"&&navigator||void 0,zr=Qe&&(!Ue||["ReactNative","NativeScript","NS"].indexOf(Ue.product)<0),Wr=(()=>typeof WorkerGlobalScope<"u"&&self instanceof WorkerGlobalScope&&typeof self.importScripts=="function")(),Jr=Qe&&window.location.href||"http://localhost",Gr=Object.freeze(Object.defineProperty({__proto__:null,hasBrowserEnv:Qe,hasStandardBrowserWebWorkerEnv:Wr,hasStandardBrowserEnv:zr,navigator:Ue,origin:Jr},Symbol.toStringTag,{value:"Module"})),_={...Gr,...Kr};function Xr(e,t){return be(e,new _.classes.URLSearchParams,{visitor:function(n,r,s,o){return _.isNode&&c.isBuffer(n)?(this.append(r,n.toString("base64")),!1):o.defaultVisitor.apply(this,arguments)},...t})}function Yr(e){return c.matchAll(/\w+|\[(\w*)]/g,e).map(t=>t[0]==="[]"?"":t[1]||t[0])}function Zr(e){const t={},n=Object.keys(e);let r;const s=n.length;let o;for(r=0;r<s;r++)o=n[r],t[o]=e[o];return t}function on(e){function t(n,r,s,o){let i=n[o++];if(i==="__proto__")return!0;const a=Number.isFinite(+i),f=o>=n.length;return i=!i&&c.isArray(s)?s.length:i,f?(c.hasOwnProp(s,i)?s[i]=[s[i],r]:s[i]=r,!a):((!s[i]||!c.isObject(s[i]))&&(s[i]=[]),t(n,r,s[i],o)&&c.isArray(s[i])&&(s[i]=Zr(s[i])),!a)}if(c.isFormData(e)&&c.isFunction(e.entries)){const n={};return c.forEachEntry(e,(r,s)=>{t(Yr(r),s,n,0)}),n}return null}function Qr(e,t,n){if(c.isString(e))try{return(t||JSON.parse)(e),c.trim(e)}catch(r){if(r.name!=="SyntaxError")throw r}return(n||JSON.stringify)(e)}const et={transitional:sn,adapter:["xhr","http","fetch"],transformRequest:[function(t,n){const r=n.getContentType()||"",s=r.indexOf("application/json")>-1,o=c.isObject(t);if(o&&c.isHTMLForm(t)&&(t=new FormData(t)),c.isFormData(t))return s?JSON.stringify(on(t)):t;if(c.isArrayBuffer(t)||c.isBuffer(t)||c.isStream(t)||c.isFile(t)||c.isBlob(t)||c.isReadableStream(t))return t;if(c.isArrayBufferView(t))return t.buffer;if(c.isURLSearchParams(t))return n.setContentType("application/x-www-form-urlencoded;charset=utf-8",!1),t.toString();let a;if(o){if(r.indexOf("application/x-www-form-urlencoded")>-1)return Xr(t,this.formSerializer).toString();if((a=c.isFileList(t))||r.indexOf("multipart/form-data")>-1){const f=this.env&&this.env.FormData;return be(a?{"files[]":t}:t,f&&new f,this.formSerializer)}}return o||s?(n.setContentType("application/json",!1),Qr(t)):t}],transformResponse:[function(t){const n=this.transitional||et.transitional,r=n&&n.forcedJSONParsing,s=this.responseType==="json";if(c.isResponse(t)||c.isReadableStream(t))return t;if(t&&c.isString(t)&&(r&&!this.responseType||s)){const i=!(n&&n.silentJSONParsing)&&s;try{return JSON.parse(t)}catch(a){if(i)throw a.name==="SyntaxError"?m.from(a,m.ERR_BAD_RESPONSE,this,null,this.response):a}}return t}],timeout:0,xsrfCookieName:"XSRF-TOKEN",xsrfHeaderName:"X-XSRF-TOKEN",maxContentLength:-1,maxBodyLength:-1,env:{FormData:_.classes.FormData,Blob:_.classes.Blob},validateStatus:function(t){return t>=200&&t<300},headers:{common:{Accept:"application/json, text/plain, */*","Content-Type":void 0}}};c.forEach(["delete","get","head","post","put","patch"],e=>{et.headers[e]={}});const tt=et,es=c.toObjectSet(["age","authorization","content-length","content-type","etag","expires","from","host","if-modified-since","if-unmodified-since","last-modified","location","max-forwards","proxy-authorization","referer","retry-after","user-agent"]),ts=e=>{const t={};let n,r,s;return e&&e.split(`
`).forEach(function(i){s=i.indexOf(":"),n=i.substring(0,s).trim().toLowerCase(),r=i.substring(s+1).trim(),!(!n||t[n]&&es[n])&&(n==="set-cookie"?t[n]?t[n].push(r):t[n]=[r]:t[n]=t[n]?t[n]+", "+r:r)}),t},wt=Symbol("internals");function X(e){return e&&String(e).trim().toLowerCase()}function ie(e){return e===!1||e==null?e:c.isArray(e)?e.map(ie):String(e)}function ns(e){const t=Object.create(null),n=/([^\s,;=]+)\s*(?:=\s*([^,;]+))?/g;let r;for(;r=n.exec(e);)t[r[1]]=r[2];return t}const rs=e=>/^[-_a-zA-Z0-9^`|~,!#$%&'*+.]+$/.test(e.trim());function Ie(e,t,n,r,s){if(c.isFunction(r))return r.call(this,t,n);if(s&&(t=n),!!c.isString(t)){if(c.isString(r))return t.indexOf(r)!==-1;if(c.isRegExp(r))return r.test(t)}}function ss(e){return e.trim().toLowerCase().replace(/([a-z\d])(\w*)/g,(t,n,r)=>n.toUpperCase()+r)}function os(e,t){const n=c.toCamelCase(" "+t);["get","set","has"].forEach(r=>{Object.defineProperty(e,r+n,{value:function(s,o,i){return this[r].call(this,t,s,o,i)},configurable:!0})})}class we{constructor(t){t&&this.set(t)}set(t,n,r){const s=this;function o(a,f,l){const u=X(f);if(!u)throw new Error("header name must be a non-empty string");const d=c.findKey(s,u);(!d||s[d]===void 0||l===!0||l===void 0&&s[d]!==!1)&&(s[d||f]=ie(a))}const i=(a,f)=>c.forEach(a,(l,u)=>o(l,u,f));if(c.isPlainObject(t)||t instanceof this.constructor)i(t,n);else if(c.isString(t)&&(t=t.trim())&&!rs(t))i(ts(t),n);else if(c.isObject(t)&&c.isIterable(t)){let a={},f,l;for(const u of t){if(!c.isArray(u))throw TypeError("Object iterator must return a key-value pair");a[l=u[0]]=(f=a[l])?c.isArray(f)?[...f,u[1]]:[f,u[1]]:u[1]}i(a,n)}else t!=null&&o(n,t,r);return this}get(t,n){if(t=X(t),t){const r=c.findKey(this,t);if(r){const s=this[r];if(!n)return s;if(n===!0)return ns(s);if(c.isFunction(n))return n.call(this,s,r);if(c.isRegExp(n))return n.exec(s);throw new TypeError("parser must be boolean|regexp|function")}}}has(t,n){if(t=X(t),t){const r=c.findKey(this,t);return!!(r&&this[r]!==void 0&&(!n||Ie(this,this[r],r,n)))}return!1}delete(t,n){const r=this;let s=!1;function o(i){if(i=X(i),i){const a=c.findKey(r,i);a&&(!n||Ie(r,r[a],a,n))&&(delete r[a],s=!0)}}return c.isArray(t)?t.forEach(o):o(t),s}clear(t){const n=Object.keys(this);let r=n.length,s=!1;for(;r--;){const o=n[r];(!t||Ie(this,this[o],o,t,!0))&&(delete this[o],s=!0)}return s}normalize(t){const n=this,r={};return c.forEach(this,(s,o)=>{const i=c.findKey(r,o);if(i){n[i]=ie(s),delete n[o];return}const a=t?ss(o):String(o).trim();a!==o&&delete n[o],n[a]=ie(s),r[a]=!0}),this}concat(...t){return this.constructor.concat(this,...t)}toJSON(t){const n=Object.create(null);return c.forEach(this,(r,s)=>{r!=null&&r!==!1&&(n[s]=t&&c.isArray(r)?r.join(", "):r)}),n}[Symbol.iterator](){return Object.entries(this.toJSON())[Symbol.iterator]()}toString(){return Object.entries(this.toJSON()).map(([t,n])=>t+": "+n).join(`
`)}getSetCookie(){return this.get("set-cookie")||[]}get[Symbol.toStringTag](){return"AxiosHeaders"}static from(t){return t instanceof this?t:new this(t)}static concat(t,...n){const r=new this(t);return n.forEach(s=>r.set(s)),r}static accessor(t){const r=(this[wt]=this[wt]={accessors:{}}).accessors,s=this.prototype;function o(i){const a=X(i);r[a]||(os(s,i),r[a]=!0)}return c.isArray(t)?t.forEach(o):o(t),this}}we.accessor(["Content-Type","Content-Length","Accept","Accept-Encoding","User-Agent","Authorization"]);c.reduceDescriptors(we.prototype,({value:e},t)=>{let n=t[0].toUpperCase()+t.slice(1);return{get:()=>e,set(r){this[n]=r}}});c.freezeMethods(we);const O=we;function Re(e,t){const n=this||tt,r=t||n,s=O.from(r.headers);let o=r.data;return c.forEach(e,function(a){o=a.call(n,o,s.normalize(),t?t.status:void 0)}),s.normalize(),o}function an(e){return!!(e&&e.__CANCEL__)}function J(e,t,n){m.call(this,e==null?"canceled":e,m.ERR_CANCELED,t,n),this.name="CanceledError"}c.inherits(J,m,{__CANCEL__:!0});function cn(e,t,n){const r=n.config.validateStatus;!n.status||!r||r(n.status)?e(n):t(new m("Request failed with status code "+n.status,[m.ERR_BAD_REQUEST,m.ERR_BAD_RESPONSE][Math.floor(n.status/100)-4],n.config,n.request,n))}function is(e){const t=/^([-+\w]{1,25})(:?\/\/|:)/.exec(e);return t&&t[1]||""}function as(e,t){e=e||10;const n=new Array(e),r=new Array(e);let s=0,o=0,i;return t=t!==void 0?t:1e3,function(f){const l=Date.now(),u=r[o];i||(i=l),n[s]=f,r[s]=l;let d=o,b=0;for(;d!==s;)b+=n[d++],d=d%e;if(s=(s+1)%e,s===o&&(o=(o+1)%e),l-i<t)return;const y=u&&l-u;return y?Math.round(b*1e3/y):void 0}}function cs(e,t){let n=0,r=1e3/t,s,o;const i=(l,u=Date.now())=>{n=u,s=null,o&&(clearTimeout(o),o=null),e(...l)};return[(...l)=>{const u=Date.now(),d=u-n;d>=r?i(l,u):(s=l,o||(o=setTimeout(()=>{o=null,i(s)},r-d)))},()=>s&&i(s)]}const ue=(e,t,n=3)=>{let r=0;const s=as(50,250);return cs(o=>{const i=o.loaded,a=o.lengthComputable?o.total:void 0,f=i-r,l=s(f),u=i<=a;r=i;const d={loaded:i,total:a,progress:a?i/a:void 0,bytes:f,rate:l||void 0,estimated:l&&a&&u?(a-i)/l:void 0,event:o,lengthComputable:a!=null,[t?"download":"upload"]:!0};e(d)},n)},yt=(e,t)=>{const n=e!=null;return[r=>t[0]({lengthComputable:n,total:e,loaded:r}),t[1]]},Et=e=>(...t)=>c.asap(()=>e(...t)),us=_.hasStandardBrowserEnv?((e,t)=>n=>(n=new URL(n,_.origin),e.protocol===n.protocol&&e.host===n.host&&(t||e.port===n.port)))(new URL(_.origin),_.navigator&&/(msie|trident)/i.test(_.navigator.userAgent)):()=>!0,ls=_.hasStandardBrowserEnv?{write(e,t,n,r,s,o){const i=[e+"="+encodeURIComponent(t)];c.isNumber(n)&&i.push("expires="+new Date(n).toGMTString()),c.isString(r)&&i.push("path="+r),c.isString(s)&&i.push("domain="+s),o===!0&&i.push("secure"),document.cookie=i.join("; ")},read(e){const t=document.cookie.match(new RegExp("(^|;\\s*)("+e+")=([^;]*)"));return t?decodeURIComponent(t[3]):null},remove(e){this.write(e,"",Date.now()-864e5)}}:{write(){},read(){return null},remove(){}};function fs(e){return/^([a-z][a-z\d+\-.]*:)?\/\//i.test(e)}function ds(e,t){return t?e.replace(/\/?\/$/,"")+"/"+t.replace(/^\/+/,""):e}function un(e,t,n){let r=!fs(t);return e&&(r||n==!1)?ds(e,t):t}const St=e=>e instanceof O?{...e}:e;function q(e,t){t=t||{};const n={};function r(l,u,d,b){return c.isPlainObject(l)&&c.isPlainObject(u)?c.merge.call({caseless:b},l,u):c.isPlainObject(u)?c.merge({},u):c.isArray(u)?u.slice():u}function s(l,u,d,b){if(c.isUndefined(u)){if(!c.isUndefined(l))return r(void 0,l,d,b)}else return r(l,u,d,b)}function o(l,u){if(!c.isUndefined(u))return r(void 0,u)}function i(l,u){if(c.isUndefined(u)){if(!c.isUndefined(l))return r(void 0,l)}else return r(void 0,u)}function a(l,u,d){if(d in t)return r(l,u);if(d in e)return r(void 0,l)}const f={url:o,method:o,data:o,baseURL:i,transformRequest:i,transformResponse:i,paramsSerializer:i,timeout:i,timeoutMessage:i,withCredentials:i,withXSRFToken:i,adapter:i,responseType:i,xsrfCookieName:i,xsrfHeaderName:i,onUploadProgress:i,onDownloadProgress:i,decompress:i,maxContentLength:i,maxBodyLength:i,beforeRedirect:i,transport:i,httpAgent:i,httpsAgent:i,cancelToken:i,socketPath:i,responseEncoding:i,validateStatus:a,headers:(l,u,d)=>s(St(l),St(u),d,!0)};return c.forEach(Object.keys({...e,...t}),function(u){const d=f[u]||s,b=d(e[u],t[u],u);c.isUndefined(b)&&d!==a||(n[u]=b)}),n}const ln=e=>{const t=q({},e);let{data:n,withXSRFToken:r,xsrfHeaderName:s,xsrfCookieName:o,headers:i,auth:a}=t;t.headers=i=O.from(i),t.url=rn(un(t.baseURL,t.url,t.allowAbsoluteUrls),e.params,e.paramsSerializer),a&&i.set("Authorization","Basic "+btoa((a.username||"")+":"+(a.password?unescape(encodeURIComponent(a.password)):"")));let f;if(c.isFormData(n)){if(_.hasStandardBrowserEnv||_.hasStandardBrowserWebWorkerEnv)i.setContentType(void 0);else if((f=i.getContentType())!==!1){const[l,...u]=f?f.split(";").map(d=>d.trim()).filter(Boolean):[];i.setContentType([l||"multipart/form-data",...u].join("; "))}}if(_.hasStandardBrowserEnv&&(r&&c.isFunction(r)&&(r=r(t)),r||r!==!1&&us(t.url))){const l=s&&o&&ls.read(o);l&&i.set(s,l)}return t},hs=typeof XMLHttpRequest<"u",ps=hs&&function(e){return new Promise(function(n,r){const s=ln(e);let o=s.data;const i=O.from(s.headers).normalize();let{responseType:a,onUploadProgress:f,onDownloadProgress:l}=s,u,d,b,y,h;function g(){y&&y(),h&&h(),s.cancelToken&&s.cancelToken.unsubscribe(u),s.signal&&s.signal.removeEventListener("abort",u)}let p=new XMLHttpRequest;p.open(s.method.toUpperCase(),s.url,!0),p.timeout=s.timeout;function E(){if(!p)return;const A=O.from("getAllResponseHeaders"in p&&p.getAllResponseHeaders()),R={data:!a||a==="text"||a==="json"?p.responseText:p.response,status:p.status,statusText:p.statusText,headers:A,config:e,request:p};cn(function($){n($),g()},function($){r($),g()},R),p=null}"onloadend"in p?p.onloadend=E:p.onreadystatechange=function(){!p||p.readyState!==4||p.status===0&&!(p.responseURL&&p.responseURL.indexOf("file:")===0)||setTimeout(E)},p.onabort=function(){!p||(r(new m("Request aborted",m.ECONNABORTED,e,p)),p=null)},p.onerror=function(){r(new m("Network Error",m.ERR_NETWORK,e,p)),p=null},p.ontimeout=function(){let N=s.timeout?"timeout of "+s.timeout+"ms exceeded":"timeout exceeded";const R=s.transitional||sn;s.timeoutErrorMessage&&(N=s.timeoutErrorMessage),r(new m(N,R.clarifyTimeoutError?m.ETIMEDOUT:m.ECONNABORTED,e,p)),p=null},o===void 0&&i.setContentType(null),"setRequestHeader"in p&&c.forEach(i.toJSON(),function(N,R){p.setRequestHeader(R,N)}),c.isUndefined(s.withCredentials)||(p.withCredentials=!!s.withCredentials),a&&a!=="json"&&(p.responseType=s.responseType),l&&([b,h]=ue(l,!0),p.addEventListener("progress",b)),f&&p.upload&&([d,y]=ue(f),p.upload.addEventListener("progress",d),p.upload.addEventListener("loadend",y)),(s.cancelToken||s.signal)&&(u=A=>{!p||(r(!A||A.type?new J(null,e,p):A),p.abort(),p=null)},s.cancelToken&&s.cancelToken.subscribe(u),s.signal&&(s.signal.aborted?u():s.signal.addEventListener("abort",u)));const T=is(s.url);if(T&&_.protocols.indexOf(T)===-1){r(new m("Unsupported protocol "+T+":",m.ERR_BAD_REQUEST,e));return}p.send(o||null)})},ms=(e,t)=>{const{length:n}=e=e?e.filter(Boolean):[];if(t||n){let r=new AbortController,s;const o=function(l){if(!s){s=!0,a();const u=l instanceof Error?l:this.reason;r.abort(u instanceof m?u:new J(u instanceof Error?u.message:u))}};let i=t&&setTimeout(()=>{i=null,o(new m(`timeout ${t} of ms exceeded`,m.ETIMEDOUT))},t);const a=()=>{e&&(i&&clearTimeout(i),i=null,e.forEach(l=>{l.unsubscribe?l.unsubscribe(o):l.removeEventListener("abort",o)}),e=null)};e.forEach(l=>l.addEventListener("abort",o));const{signal:f}=r;return f.unsubscribe=()=>c.asap(a),f}},gs=ms,bs=function*(e,t){let n=e.byteLength;if(!t||n<t){yield e;return}let r=0,s;for(;r<n;)s=r+t,yield e.slice(r,s),r=s},ws=async function*(e,t){for await(const n of ys(e))yield*bs(n,t)},ys=async function*(e){if(e[Symbol.asyncIterator]){yield*e;return}const t=e.getReader();try{for(;;){const{done:n,value:r}=await t.read();if(n)break;yield r}}finally{await t.cancel()}},Tt=(e,t,n,r)=>{const s=ws(e,t);let o=0,i,a=f=>{i||(i=!0,r&&r(f))};return new ReadableStream({async pull(f){try{const{done:l,value:u}=await s.next();if(l){a(),f.close();return}let d=u.byteLength;if(n){let b=o+=d;n(b)}f.enqueue(new Uint8Array(u))}catch(l){throw a(l),l}},cancel(f){return a(f),s.return()}},{highWaterMark:2})},ye=typeof fetch=="function"&&typeof Request=="function"&&typeof Response=="function",fn=ye&&typeof ReadableStream=="function",Es=ye&&(typeof TextEncoder=="function"?(e=>t=>e.encode(t))(new TextEncoder):async e=>new Uint8Array(await new Response(e).arrayBuffer())),dn=(e,...t)=>{try{return!!e(...t)}catch{return!1}},Ss=fn&&dn(()=>{let e=!1;const t=new Request(_.origin,{body:new ReadableStream,method:"POST",get duplex(){return e=!0,"half"}}).headers.has("Content-Type");return e&&!t}),At=64*1024,je=fn&&dn(()=>c.isReadableStream(new Response("").body)),le={stream:je&&(e=>e.body)};ye&&(e=>{["text","arrayBuffer","blob","formData","stream"].forEach(t=>{!le[t]&&(le[t]=c.isFunction(e[t])?n=>n[t]():(n,r)=>{throw new m(`Response type '${t}' is not supported`,m.ERR_NOT_SUPPORT,r)})})})(new Response);const Ts=async e=>{if(e==null)return 0;if(c.isBlob(e))return e.size;if(c.isSpecCompliantForm(e))return(await new Request(_.origin,{method:"POST",body:e}).arrayBuffer()).byteLength;if(c.isArrayBufferView(e)||c.isArrayBuffer(e))return e.byteLength;if(c.isURLSearchParams(e)&&(e=e+""),c.isString(e))return(await Es(e)).byteLength},As=async(e,t)=>{const n=c.toFiniteNumber(e.getContentLength());return n==null?Ts(t):n},_s=ye&&(async e=>{let{url:t,method:n,data:r,signal:s,cancelToken:o,timeout:i,onDownloadProgress:a,onUploadProgress:f,responseType:l,headers:u,withCredentials:d="same-origin",fetchOptions:b}=ln(e);l=l?(l+"").toLowerCase():"text";let y=gs([s,o&&o.toAbortSignal()],i),h;const g=y&&y.unsubscribe&&(()=>{y.unsubscribe()});let p;try{if(f&&Ss&&n!=="get"&&n!=="head"&&(p=await As(u,r))!==0){let R=new Request(t,{method:"POST",body:r,duplex:"half"}),x;if(c.isFormData(r)&&(x=R.headers.get("content-type"))&&u.setContentType(x),R.body){const[$,se]=yt(p,ue(Et(f)));r=Tt(R.body,At,$,se)}}c.isString(d)||(d=d?"include":"omit");const E="credentials"in Request.prototype;h=new Request(t,{...b,signal:y,method:n.toUpperCase(),headers:u.normalize().toJSON(),body:r,duplex:"half",credentials:E?d:void 0});let T=await fetch(h,b);const A=je&&(l==="stream"||l==="response");if(je&&(a||A&&g)){const R={};["status","statusText","headers"].forEach(ht=>{R[ht]=T[ht]});const x=c.toFiniteNumber(T.headers.get("content-length")),[$,se]=a&&yt(x,ue(Et(a),!0))||[];T=new Response(Tt(T.body,At,$,()=>{se&&se(),g&&g()}),R)}l=l||"text";let N=await le[c.findKey(le,l)||"text"](T,e);return!A&&g&&g(),await new Promise((R,x)=>{cn(R,x,{data:N,headers:O.from(T.headers),status:T.status,statusText:T.statusText,config:e,request:h})})}catch(E){throw g&&g(),E&&E.name==="TypeError"&&/Load failed|fetch/i.test(E.message)?Object.assign(new m("Network Error",m.ERR_NETWORK,e,h),{cause:E.cause||E}):m.from(E,E&&E.code,e,h)}}),He={http:Mr,xhr:ps,fetch:_s};c.forEach(He,(e,t)=>{if(e){try{Object.defineProperty(e,"name",{value:t})}catch{}Object.defineProperty(e,"adapterName",{value:t})}});const _t=e=>`- ${e}`,Is=e=>c.isFunction(e)||e===null||e===!1,hn={getAdapter:e=>{e=c.isArray(e)?e:[e];const{length:t}=e;let n,r;const s={};for(let o=0;o<t;o++){n=e[o];let i;if(r=n,!Is(n)&&(r=He[(i=String(n)).toLowerCase()],r===void 0))throw new m(`Unknown adapter '${i}'`);if(r)break;s[i||"#"+o]=r}if(!r){const o=Object.entries(s).map(([a,f])=>`adapter ${a} `+(f===!1?"is not supported by the environment":"is not available in the build"));let i=t?o.length>1?`since :
`+o.map(_t).join(`
`):" "+_t(o[0]):"as no adapter specified";throw new m("There is no suitable adapter to dispatch the request "+i,"ERR_NOT_SUPPORT")}return r},adapters:He};function Ce(e){if(e.cancelToken&&e.cancelToken.throwIfRequested(),e.signal&&e.signal.aborted)throw new J(null,e)}function It(e){return Ce(e),e.headers=O.from(e.headers),e.data=Re.call(e,e.transformRequest),["post","put","patch"].indexOf(e.method)!==-1&&e.headers.setContentType("application/x-www-form-urlencoded",!1),hn.getAdapter(e.adapter||tt.adapter)(e).then(function(r){return Ce(e),r.data=Re.call(e,e.transformResponse,r),r.headers=O.from(r.headers),r},function(r){return an(r)||(Ce(e),r&&r.response&&(r.response.data=Re.call(e,e.transformResponse,r.response),r.response.headers=O.from(r.response.headers))),Promise.reject(r)})}const pn="1.11.0",Ee={};["object","boolean","number","function","string","symbol"].forEach((e,t)=>{Ee[e]=function(r){return typeof r===e||"a"+(t<1?"n ":" ")+e}});const Rt={};Ee.transitional=function(t,n,r){function s(o,i){return"[Axios v"+pn+"] Transitional option '"+o+"'"+i+(r?". "+r:"")}return(o,i,a)=>{if(t===!1)throw new m(s(i," has been removed"+(n?" in "+n:"")),m.ERR_DEPRECATED);return n&&!Rt[i]&&(Rt[i]=!0,console.warn(s(i," has been deprecated since v"+n+" and will be removed in the near future"))),t?t(o,i,a):!0}};Ee.spelling=function(t){return(n,r)=>(console.warn(`${r} is likely a misspelling of ${t}`),!0)};function Rs(e,t,n){if(typeof e!="object")throw new m("options must be an object",m.ERR_BAD_OPTION_VALUE);const r=Object.keys(e);let s=r.length;for(;s-- >0;){const o=r[s],i=t[o];if(i){const a=e[o],f=a===void 0||i(a,o,e);if(f!==!0)throw new m("option "+o+" must be "+f,m.ERR_BAD_OPTION_VALUE);continue}if(n!==!0)throw new m("Unknown option "+o,m.ERR_BAD_OPTION)}}const ae={assertOptions:Rs,validators:Ee},k=ae.validators;class fe{constructor(t){this.defaults=t||{},this.interceptors={request:new bt,response:new bt}}async request(t,n){try{return await this._request(t,n)}catch(r){if(r instanceof Error){let s={};Error.captureStackTrace?Error.captureStackTrace(s):s=new Error;const o=s.stack?s.stack.replace(/^.+\n/,""):"";try{r.stack?o&&!String(r.stack).endsWith(o.replace(/^.+\n.+\n/,""))&&(r.stack+=`
`+o):r.stack=o}catch{}}throw r}}_request(t,n){typeof t=="string"?(n=n||{},n.url=t):n=t||{},n=q(this.defaults,n);const{transitional:r,paramsSerializer:s,headers:o}=n;r!==void 0&&ae.assertOptions(r,{silentJSONParsing:k.transitional(k.boolean),forcedJSONParsing:k.transitional(k.boolean),clarifyTimeoutError:k.transitional(k.boolean)},!1),s!=null&&(c.isFunction(s)?n.paramsSerializer={serialize:s}:ae.assertOptions(s,{encode:k.function,serialize:k.function},!0)),n.allowAbsoluteUrls!==void 0||(this.defaults.allowAbsoluteUrls!==void 0?n.allowAbsoluteUrls=this.defaults.allowAbsoluteUrls:n.allowAbsoluteUrls=!0),ae.assertOptions(n,{baseUrl:k.spelling("baseURL"),withXsrfToken:k.spelling("withXSRFToken")},!0),n.method=(n.method||this.defaults.method||"get").toLowerCase();let i=o&&c.merge(o.common,o[n.method]);o&&c.forEach(["delete","get","head","post","put","patch","common"],h=>{delete o[h]}),n.headers=O.concat(i,o);const a=[];let f=!0;this.interceptors.request.forEach(function(g){typeof g.runWhen=="function"&&g.runWhen(n)===!1||(f=f&&g.synchronous,a.unshift(g.fulfilled,g.rejected))});const l=[];this.interceptors.response.forEach(function(g){l.push(g.fulfilled,g.rejected)});let u,d=0,b;if(!f){const h=[It.bind(this),void 0];for(h.unshift(...a),h.push(...l),b=h.length,u=Promise.resolve(n);d<b;)u=u.then(h[d++],h[d++]);return u}b=a.length;let y=n;for(d=0;d<b;){const h=a[d++],g=a[d++];try{y=h(y)}catch(p){g.call(this,p);break}}try{u=It.call(this,y)}catch(h){return Promise.reject(h)}for(d=0,b=l.length;d<b;)u=u.then(l[d++],l[d++]);return u}getUri(t){t=q(this.defaults,t);const n=un(t.baseURL,t.url,t.allowAbsoluteUrls);return rn(n,t.params,t.paramsSerializer)}}c.forEach(["delete","get","head","options"],function(t){fe.prototype[t]=function(n,r){return this.request(q(r||{},{method:t,url:n,data:(r||{}).data}))}});c.forEach(["post","put","patch"],function(t){function n(r){return function(o,i,a){return this.request(q(a||{},{method:t,headers:r?{"Content-Type":"multipart/form-data"}:{},url:o,data:i}))}}fe.prototype[t]=n(),fe.prototype[t+"Form"]=n(!0)});const ce=fe;class nt{constructor(t){if(typeof t!="function")throw new TypeError("executor must be a function.");let n;this.promise=new Promise(function(o){n=o});const r=this;this.promise.then(s=>{if(!r._listeners)return;let o=r._listeners.length;for(;o-- >0;)r._listeners[o](s);r._listeners=null}),this.promise.then=s=>{let o;const i=new Promise(a=>{r.subscribe(a),o=a}).then(s);return i.cancel=function(){r.unsubscribe(o)},i},t(function(o,i,a){r.reason||(r.reason=new J(o,i,a),n(r.reason))})}throwIfRequested(){if(this.reason)throw this.reason}subscribe(t){if(this.reason){t(this.reason);return}this._listeners?this._listeners.push(t):this._listeners=[t]}unsubscribe(t){if(!this._listeners)return;const n=this._listeners.indexOf(t);n!==-1&&this._listeners.splice(n,1)}toAbortSignal(){const t=new AbortController,n=r=>{t.abort(r)};return this.subscribe(n),t.signal.unsubscribe=()=>this.unsubscribe(n),t.signal}static source(){let t;return{token:new nt(function(s){t=s}),cancel:t}}}const Cs=nt;function Os(e){return function(n){return e.apply(null,n)}}function Ds(e){return c.isObject(e)&&e.isAxiosError===!0}const qe={Continue:100,SwitchingProtocols:101,Processing:102,EarlyHints:103,Ok:200,Created:201,Accepted:202,NonAuthoritativeInformation:203,NoContent:204,ResetContent:205,PartialContent:206,MultiStatus:207,AlreadyReported:208,ImUsed:226,MultipleChoices:300,MovedPermanently:301,Found:302,SeeOther:303,NotModified:304,UseProxy:305,Unused:306,TemporaryRedirect:307,PermanentRedirect:308,BadRequest:400,Unauthorized:401,PaymentRequired:402,Forbidden:403,NotFound:404,MethodNotAllowed:405,NotAcceptable:406,ProxyAuthenticationRequired:407,RequestTimeout:408,Conflict:409,Gone:410,LengthRequired:411,PreconditionFailed:412,PayloadTooLarge:413,UriTooLong:414,UnsupportedMediaType:415,RangeNotSatisfiable:416,ExpectationFailed:417,ImATeapot:418,MisdirectedRequest:421,UnprocessableEntity:422,Locked:423,FailedDependency:424,TooEarly:425,UpgradeRequired:426,PreconditionRequired:428,TooManyRequests:429,RequestHeaderFieldsTooLarge:431,UnavailableForLegalReasons:451,InternalServerError:500,NotImplemented:501,BadGateway:502,ServiceUnavailable:503,GatewayTimeout:504,HttpVersionNotSupported:505,VariantAlsoNegotiates:506,InsufficientStorage:507,LoopDetected:508,NotExtended:510,NetworkAuthenticationRequired:511};Object.entries(qe).forEach(([e,t])=>{qe[t]=e});const ks=qe;function mn(e){const t=new ce(e),n=Kt(ce.prototype.request,t);return c.extend(n,ce.prototype,t,{allOwnKeys:!0}),c.extend(n,t,null,{allOwnKeys:!0}),n.create=function(s){return mn(q(e,s))},n}const S=mn(tt);S.Axios=ce;S.CanceledError=J;S.CancelToken=Cs;S.isCancel=an;S.VERSION=pn;S.toFormData=be;S.AxiosError=m;S.Cancel=S.CanceledError;S.all=function(t){return Promise.all(t)};S.spread=Os;S.isAxiosError=Ds;S.mergeConfig=q;S.AxiosHeaders=O;S.formToJSON=e=>on(c.isHTMLForm(e)?new FormData(e):e);S.getAdapter=hn.getAdapter;S.HttpStatusCode=ks;S.default=S;const Ns=S;window.axios=Ns;window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";const vs=()=>{};/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const gn=function(e){const t=[];let n=0;for(let r=0;r<e.length;r++){let s=e.charCodeAt(r);s<128?t[n++]=s:s<2048?(t[n++]=s>>6|192,t[n++]=s&63|128):(s&64512)===55296&&r+1<e.length&&(e.charCodeAt(r+1)&64512)===56320?(s=65536+((s&1023)<<10)+(e.charCodeAt(++r)&1023),t[n++]=s>>18|240,t[n++]=s>>12&63|128,t[n++]=s>>6&63|128,t[n++]=s&63|128):(t[n++]=s>>12|224,t[n++]=s>>6&63|128,t[n++]=s&63|128)}return t},Ps=function(e){const t=[];let n=0,r=0;for(;n<e.length;){const s=e[n++];if(s<128)t[r++]=String.fromCharCode(s);else if(s>191&&s<224){const o=e[n++];t[r++]=String.fromCharCode((s&31)<<6|o&63)}else if(s>239&&s<365){const o=e[n++],i=e[n++],a=e[n++],f=((s&7)<<18|(o&63)<<12|(i&63)<<6|a&63)-65536;t[r++]=String.fromCharCode(55296+(f>>10)),t[r++]=String.fromCharCode(56320+(f&1023))}else{const o=e[n++],i=e[n++];t[r++]=String.fromCharCode((s&15)<<12|(o&63)<<6|i&63)}}return t.join("")},bn={byteToCharMap_:null,charToByteMap_:null,byteToCharMapWebSafe_:null,charToByteMapWebSafe_:null,ENCODED_VALS_BASE:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",get ENCODED_VALS(){return this.ENCODED_VALS_BASE+"+/="},get ENCODED_VALS_WEBSAFE(){return this.ENCODED_VALS_BASE+"-_."},HAS_NATIVE_SUPPORT:typeof atob=="function",encodeByteArray(e,t){if(!Array.isArray(e))throw Error("encodeByteArray takes an array as a parameter");this.init_();const n=t?this.byteToCharMapWebSafe_:this.byteToCharMap_,r=[];for(let s=0;s<e.length;s+=3){const o=e[s],i=s+1<e.length,a=i?e[s+1]:0,f=s+2<e.length,l=f?e[s+2]:0,u=o>>2,d=(o&3)<<4|a>>4;let b=(a&15)<<2|l>>6,y=l&63;f||(y=64,i||(b=64)),r.push(n[u],n[d],n[b],n[y])}return r.join("")},encodeString(e,t){return this.HAS_NATIVE_SUPPORT&&!t?btoa(e):this.encodeByteArray(gn(e),t)},decodeString(e,t){return this.HAS_NATIVE_SUPPORT&&!t?atob(e):Ps(this.decodeStringToByteArray(e,t))},decodeStringToByteArray(e,t){this.init_();const n=t?this.charToByteMapWebSafe_:this.charToByteMap_,r=[];for(let s=0;s<e.length;){const o=n[e.charAt(s++)],a=s<e.length?n[e.charAt(s)]:0;++s;const l=s<e.length?n[e.charAt(s)]:64;++s;const d=s<e.length?n[e.charAt(s)]:64;if(++s,o==null||a==null||l==null||d==null)throw new Bs;const b=o<<2|a>>4;if(r.push(b),l!==64){const y=a<<4&240|l>>2;if(r.push(y),d!==64){const h=l<<6&192|d;r.push(h)}}}return r},init_(){if(!this.byteToCharMap_){this.byteToCharMap_={},this.charToByteMap_={},this.byteToCharMapWebSafe_={},this.charToByteMapWebSafe_={};for(let e=0;e<this.ENCODED_VALS.length;e++)this.byteToCharMap_[e]=this.ENCODED_VALS.charAt(e),this.charToByteMap_[this.byteToCharMap_[e]]=e,this.byteToCharMapWebSafe_[e]=this.ENCODED_VALS_WEBSAFE.charAt(e),this.charToByteMapWebSafe_[this.byteToCharMapWebSafe_[e]]=e,e>=this.ENCODED_VALS_BASE.length&&(this.charToByteMap_[this.ENCODED_VALS_WEBSAFE.charAt(e)]=e,this.charToByteMapWebSafe_[this.ENCODED_VALS.charAt(e)]=e)}}};class Bs extends Error{constructor(){super(...arguments),this.name="DecodeBase64StringError"}}const xs=function(e){const t=gn(e);return bn.encodeByteArray(t,!0)},wn=function(e){return xs(e).replace(/\./g,"")},Fs=function(e){try{return bn.decodeString(e,!0)}catch(t){console.error("base64Decode failed: ",t)}return null};/**
 * @license
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ms(){if(typeof self<"u")return self;if(typeof window<"u")return window;if(typeof global<"u")return global;throw new Error("Unable to locate global object.")}/**
 * @license
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ls=()=>Ms().__FIREBASE_DEFAULTS__,$s=()=>{if(typeof process>"u"||typeof process.env>"u")return;const e={}.__FIREBASE_DEFAULTS__;if(e)return JSON.parse(e)},Us=()=>{if(typeof document>"u")return;let e;try{e=document.cookie.match(/__FIREBASE_DEFAULTS__=([^;]+)/)}catch{return}const t=e&&Fs(e[1]);return t&&JSON.parse(t)},js=()=>{try{return vs()||Ls()||$s()||Us()}catch(e){console.info(`Unable to get __FIREBASE_DEFAULTS__ due to: ${e}`);return}},yn=()=>{var e;return(e=js())==null?void 0:e.config};/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Hs{constructor(){this.reject=()=>{},this.resolve=()=>{},this.promise=new Promise((t,n)=>{this.resolve=t,this.reject=n})}wrapCallback(t){return(n,r)=>{n?this.reject(n):this.resolve(r),typeof t=="function"&&(this.promise.catch(()=>{}),t.length===1?t(n):t(n,r))}}}function En(){try{return typeof indexedDB=="object"}catch{return!1}}function Sn(){return new Promise((e,t)=>{try{let n=!0;const r="validate-browser-context-for-indexeddb-analytics-module",s=self.indexedDB.open(r);s.onsuccess=()=>{s.result.close(),n||self.indexedDB.deleteDatabase(r),e(!0)},s.onupgradeneeded=()=>{n=!1},s.onerror=()=>{var o;t(((o=s.error)==null?void 0:o.message)||"")}}catch(n){t(n)}})}function qs(){return!(typeof navigator>"u"||!navigator.cookieEnabled)}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Vs="FirebaseError";class G extends Error{constructor(t,n,r){super(n),this.code=t,this.customData=r,this.name=Vs,Object.setPrototypeOf(this,G.prototype),Error.captureStackTrace&&Error.captureStackTrace(this,Se.prototype.create)}}class Se{constructor(t,n,r){this.service=t,this.serviceName=n,this.errors=r}create(t,...n){const r=n[0]||{},s=`${this.service}/${t}`,o=this.errors[t],i=o?Ks(o,r):"Error",a=`${this.serviceName}: ${i} (${s}).`;return new G(s,a,r)}}function Ks(e,t){return e.replace(zs,(n,r)=>{const s=t[r];return s!=null?String(s):`<${r}?>`})}const zs=/\{\$([^}]+)}/g;function Ve(e,t){if(e===t)return!0;const n=Object.keys(e),r=Object.keys(t);for(const s of n){if(!r.includes(s))return!1;const o=e[s],i=t[s];if(Ct(o)&&Ct(i)){if(!Ve(o,i))return!1}else if(o!==i)return!1}for(const s of r)if(!n.includes(s))return!1;return!0}function Ct(e){return e!==null&&typeof e=="object"}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function rt(e){return e&&e._delegate?e._delegate:e}class L{constructor(t,n,r){this.name=t,this.instanceFactory=n,this.type=r,this.multipleInstances=!1,this.serviceProps={},this.instantiationMode="LAZY",this.onInstanceCreated=null}setInstantiationMode(t){return this.instantiationMode=t,this}setMultipleInstances(t){return this.multipleInstances=t,this}setServiceProps(t){return this.serviceProps=t,this}setInstanceCreatedCallback(t){return this.onInstanceCreated=t,this}}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const U="[DEFAULT]";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Ws{constructor(t,n){this.name=t,this.container=n,this.component=null,this.instances=new Map,this.instancesDeferred=new Map,this.instancesOptions=new Map,this.onInitCallbacks=new Map}get(t){const n=this.normalizeInstanceIdentifier(t);if(!this.instancesDeferred.has(n)){const r=new Hs;if(this.instancesDeferred.set(n,r),this.isInitialized(n)||this.shouldAutoInitialize())try{const s=this.getOrInitializeService({instanceIdentifier:n});s&&r.resolve(s)}catch{}}return this.instancesDeferred.get(n).promise}getImmediate(t){var s;const n=this.normalizeInstanceIdentifier(t==null?void 0:t.identifier),r=(s=t==null?void 0:t.optional)!=null?s:!1;if(this.isInitialized(n)||this.shouldAutoInitialize())try{return this.getOrInitializeService({instanceIdentifier:n})}catch(o){if(r)return null;throw o}else{if(r)return null;throw Error(`Service ${this.name} is not available`)}}getComponent(){return this.component}setComponent(t){if(t.name!==this.name)throw Error(`Mismatching Component ${t.name} for Provider ${this.name}.`);if(this.component)throw Error(`Component for ${this.name} has already been provided`);if(this.component=t,!!this.shouldAutoInitialize()){if(Gs(t))try{this.getOrInitializeService({instanceIdentifier:U})}catch{}for(const[n,r]of this.instancesDeferred.entries()){const s=this.normalizeInstanceIdentifier(n);try{const o=this.getOrInitializeService({instanceIdentifier:s});r.resolve(o)}catch{}}}}clearInstance(t=U){this.instancesDeferred.delete(t),this.instancesOptions.delete(t),this.instances.delete(t)}async delete(){const t=Array.from(this.instances.values());await Promise.all([...t.filter(n=>"INTERNAL"in n).map(n=>n.INTERNAL.delete()),...t.filter(n=>"_delete"in n).map(n=>n._delete())])}isComponentSet(){return this.component!=null}isInitialized(t=U){return this.instances.has(t)}getOptions(t=U){return this.instancesOptions.get(t)||{}}initialize(t={}){const{options:n={}}=t,r=this.normalizeInstanceIdentifier(t.instanceIdentifier);if(this.isInitialized(r))throw Error(`${this.name}(${r}) has already been initialized`);if(!this.isComponentSet())throw Error(`Component ${this.name} has not been registered yet`);const s=this.getOrInitializeService({instanceIdentifier:r,options:n});for(const[o,i]of this.instancesDeferred.entries()){const a=this.normalizeInstanceIdentifier(o);r===a&&i.resolve(s)}return s}onInit(t,n){var i;const r=this.normalizeInstanceIdentifier(n),s=(i=this.onInitCallbacks.get(r))!=null?i:new Set;s.add(t),this.onInitCallbacks.set(r,s);const o=this.instances.get(r);return o&&t(o,r),()=>{s.delete(t)}}invokeOnInitCallbacks(t,n){const r=this.onInitCallbacks.get(n);if(!!r)for(const s of r)try{s(t,n)}catch{}}getOrInitializeService({instanceIdentifier:t,options:n={}}){let r=this.instances.get(t);if(!r&&this.component&&(r=this.component.instanceFactory(this.container,{instanceIdentifier:Js(t),options:n}),this.instances.set(t,r),this.instancesOptions.set(t,n),this.invokeOnInitCallbacks(r,t),this.component.onInstanceCreated))try{this.component.onInstanceCreated(this.container,t,r)}catch{}return r||null}normalizeInstanceIdentifier(t=U){return this.component?this.component.multipleInstances?t:U:t}shouldAutoInitialize(){return!!this.component&&this.component.instantiationMode!=="EXPLICIT"}}function Js(e){return e===U?void 0:e}function Gs(e){return e.instantiationMode==="EAGER"}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Xs{constructor(t){this.name=t,this.providers=new Map}addComponent(t){const n=this.getProvider(t.name);if(n.isComponentSet())throw new Error(`Component ${t.name} has already been registered with ${this.name}`);n.setComponent(t)}addOrOverwriteComponent(t){this.getProvider(t.name).isComponentSet()&&this.providers.delete(t.name),this.addComponent(t)}getProvider(t){if(this.providers.has(t))return this.providers.get(t);const n=new Ws(t,this);return this.providers.set(t,n),n}getProviders(){return Array.from(this.providers.values())}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var w;(function(e){e[e.DEBUG=0]="DEBUG",e[e.VERBOSE=1]="VERBOSE",e[e.INFO=2]="INFO",e[e.WARN=3]="WARN",e[e.ERROR=4]="ERROR",e[e.SILENT=5]="SILENT"})(w||(w={}));const Ys={debug:w.DEBUG,verbose:w.VERBOSE,info:w.INFO,warn:w.WARN,error:w.ERROR,silent:w.SILENT},Zs=w.INFO,Qs={[w.DEBUG]:"log",[w.VERBOSE]:"log",[w.INFO]:"info",[w.WARN]:"warn",[w.ERROR]:"error"},eo=(e,t,...n)=>{if(t<e.logLevel)return;const r=new Date().toISOString(),s=Qs[t];if(s)console[s](`[${r}]  ${e.name}:`,...n);else throw new Error(`Attempted to log a message with an invalid logType (value: ${t})`)};class to{constructor(t){this.name=t,this._logLevel=Zs,this._logHandler=eo,this._userLogHandler=null}get logLevel(){return this._logLevel}set logLevel(t){if(!(t in w))throw new TypeError(`Invalid value "${t}" assigned to \`logLevel\``);this._logLevel=t}setLogLevel(t){this._logLevel=typeof t=="string"?Ys[t]:t}get logHandler(){return this._logHandler}set logHandler(t){if(typeof t!="function")throw new TypeError("Value assigned to `logHandler` must be a function");this._logHandler=t}get userLogHandler(){return this._userLogHandler}set userLogHandler(t){this._userLogHandler=t}debug(...t){this._userLogHandler&&this._userLogHandler(this,w.DEBUG,...t),this._logHandler(this,w.DEBUG,...t)}log(...t){this._userLogHandler&&this._userLogHandler(this,w.VERBOSE,...t),this._logHandler(this,w.VERBOSE,...t)}info(...t){this._userLogHandler&&this._userLogHandler(this,w.INFO,...t),this._logHandler(this,w.INFO,...t)}warn(...t){this._userLogHandler&&this._userLogHandler(this,w.WARN,...t),this._logHandler(this,w.WARN,...t)}error(...t){this._userLogHandler&&this._userLogHandler(this,w.ERROR,...t),this._logHandler(this,w.ERROR,...t)}}const no=(e,t)=>t.some(n=>e instanceof n);let Ot,Dt;function ro(){return Ot||(Ot=[IDBDatabase,IDBObjectStore,IDBIndex,IDBCursor,IDBTransaction])}function so(){return Dt||(Dt=[IDBCursor.prototype.advance,IDBCursor.prototype.continue,IDBCursor.prototype.continuePrimaryKey])}const Tn=new WeakMap,Ke=new WeakMap,An=new WeakMap,Oe=new WeakMap,st=new WeakMap;function oo(e){const t=new Promise((n,r)=>{const s=()=>{e.removeEventListener("success",o),e.removeEventListener("error",i)},o=()=>{n(P(e.result)),s()},i=()=>{r(e.error),s()};e.addEventListener("success",o),e.addEventListener("error",i)});return t.then(n=>{n instanceof IDBCursor&&Tn.set(n,e)}).catch(()=>{}),st.set(t,e),t}function io(e){if(Ke.has(e))return;const t=new Promise((n,r)=>{const s=()=>{e.removeEventListener("complete",o),e.removeEventListener("error",i),e.removeEventListener("abort",i)},o=()=>{n(),s()},i=()=>{r(e.error||new DOMException("AbortError","AbortError")),s()};e.addEventListener("complete",o),e.addEventListener("error",i),e.addEventListener("abort",i)});Ke.set(e,t)}let ze={get(e,t,n){if(e instanceof IDBTransaction){if(t==="done")return Ke.get(e);if(t==="objectStoreNames")return e.objectStoreNames||An.get(e);if(t==="store")return n.objectStoreNames[1]?void 0:n.objectStore(n.objectStoreNames[0])}return P(e[t])},set(e,t,n){return e[t]=n,!0},has(e,t){return e instanceof IDBTransaction&&(t==="done"||t==="store")?!0:t in e}};function ao(e){ze=e(ze)}function co(e){return e===IDBDatabase.prototype.transaction&&!("objectStoreNames"in IDBTransaction.prototype)?function(t,...n){const r=e.call(De(this),t,...n);return An.set(r,t.sort?t.sort():[t]),P(r)}:so().includes(e)?function(...t){return e.apply(De(this),t),P(Tn.get(this))}:function(...t){return P(e.apply(De(this),t))}}function uo(e){return typeof e=="function"?co(e):(e instanceof IDBTransaction&&io(e),no(e,ro())?new Proxy(e,ze):e)}function P(e){if(e instanceof IDBRequest)return oo(e);if(Oe.has(e))return Oe.get(e);const t=uo(e);return t!==e&&(Oe.set(e,t),st.set(t,e)),t}const De=e=>st.get(e);function Te(e,t,{blocked:n,upgrade:r,blocking:s,terminated:o}={}){const i=indexedDB.open(e,t),a=P(i);return r&&i.addEventListener("upgradeneeded",f=>{r(P(i.result),f.oldVersion,f.newVersion,P(i.transaction),f)}),n&&i.addEventListener("blocked",f=>n(f.oldVersion,f.newVersion,f)),a.then(f=>{o&&f.addEventListener("close",()=>o()),s&&f.addEventListener("versionchange",l=>s(l.oldVersion,l.newVersion,l))}).catch(()=>{}),a}function ke(e,{blocked:t}={}){const n=indexedDB.deleteDatabase(e);return t&&n.addEventListener("blocked",r=>t(r.oldVersion,r)),P(n).then(()=>{})}const lo=["get","getKey","getAll","getAllKeys","count"],fo=["put","add","delete","clear"],Ne=new Map;function kt(e,t){if(!(e instanceof IDBDatabase&&!(t in e)&&typeof t=="string"))return;if(Ne.get(t))return Ne.get(t);const n=t.replace(/FromIndex$/,""),r=t!==n,s=fo.includes(n);if(!(n in(r?IDBIndex:IDBObjectStore).prototype)||!(s||lo.includes(n)))return;const o=async function(i,...a){const f=this.transaction(i,s?"readwrite":"readonly");let l=f.store;return r&&(l=l.index(a.shift())),(await Promise.all([l[n](...a),s&&f.done]))[0]};return Ne.set(t,o),o}ao(e=>({...e,get:(t,n,r)=>kt(t,n)||e.get(t,n,r),has:(t,n)=>!!kt(t,n)||e.has(t,n)}));/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class ho{constructor(t){this.container=t}getPlatformInfoString(){return this.container.getProviders().map(n=>{if(po(n)){const r=n.getImmediate();return`${r.library}/${r.version}`}else return null}).filter(n=>n).join(" ")}}function po(e){const t=e.getComponent();return(t==null?void 0:t.type)==="VERSION"}const We="@firebase/app",Nt="0.14.0";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const B=new to("@firebase/app"),mo="@firebase/app-compat",go="@firebase/analytics-compat",bo="@firebase/analytics",wo="@firebase/app-check-compat",yo="@firebase/app-check",Eo="@firebase/auth",So="@firebase/auth-compat",To="@firebase/database",Ao="@firebase/data-connect",_o="@firebase/database-compat",Io="@firebase/functions",Ro="@firebase/functions-compat",Co="@firebase/installations",Oo="@firebase/installations-compat",Do="@firebase/messaging",ko="@firebase/messaging-compat",No="@firebase/performance",vo="@firebase/performance-compat",Po="@firebase/remote-config",Bo="@firebase/remote-config-compat",xo="@firebase/storage",Fo="@firebase/storage-compat",Mo="@firebase/firestore",Lo="@firebase/ai",$o="@firebase/firestore-compat",Uo="firebase";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Je="[DEFAULT]",jo={[We]:"fire-core",[mo]:"fire-core-compat",[bo]:"fire-analytics",[go]:"fire-analytics-compat",[yo]:"fire-app-check",[wo]:"fire-app-check-compat",[Eo]:"fire-auth",[So]:"fire-auth-compat",[To]:"fire-rtdb",[Ao]:"fire-data-connect",[_o]:"fire-rtdb-compat",[Io]:"fire-fn",[Ro]:"fire-fn-compat",[Co]:"fire-iid",[Oo]:"fire-iid-compat",[Do]:"fire-fcm",[ko]:"fire-fcm-compat",[No]:"fire-perf",[vo]:"fire-perf-compat",[Po]:"fire-rc",[Bo]:"fire-rc-compat",[xo]:"fire-gcs",[Fo]:"fire-gcs-compat",[Mo]:"fire-fst",[$o]:"fire-fst-compat",[Lo]:"fire-vertex","fire-js":"fire-js",[Uo]:"fire-js-all"};/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const de=new Map,Ho=new Map,Ge=new Map;function vt(e,t){try{e.container.addComponent(t)}catch(n){B.debug(`Component ${t.name} failed to register with FirebaseApp ${e.name}`,n)}}function V(e){const t=e.name;if(Ge.has(t))return B.debug(`There were multiple attempts to register component ${t}.`),!1;Ge.set(t,e);for(const n of de.values())vt(n,e);for(const n of Ho.values())vt(n,e);return!0}function ot(e,t){const n=e.container.getProvider("heartbeat").getImmediate({optional:!0});return n&&n.triggerHeartbeat(),e.container.getProvider(t)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const qo={["no-app"]:"No Firebase App '{$appName}' has been created - call initializeApp() first",["bad-app-name"]:"Illegal App name: '{$appName}'",["duplicate-app"]:"Firebase App named '{$appName}' already exists with different options or config",["app-deleted"]:"Firebase App named '{$appName}' already deleted",["server-app-deleted"]:"Firebase Server App has been deleted",["no-options"]:"Need to provide options, when not being deployed to hosting via source.",["invalid-app-argument"]:"firebase.{$appName}() takes either no argument or a Firebase App instance.",["invalid-log-argument"]:"First argument to `onLog` must be null or a function.",["idb-open"]:"Error thrown when opening IndexedDB. Original error: {$originalErrorMessage}.",["idb-get"]:"Error thrown when reading from IndexedDB. Original error: {$originalErrorMessage}.",["idb-set"]:"Error thrown when writing to IndexedDB. Original error: {$originalErrorMessage}.",["idb-delete"]:"Error thrown when deleting from IndexedDB. Original error: {$originalErrorMessage}.",["finalization-registry-not-supported"]:"FirebaseServerApp deleteOnDeref field defined but the JS runtime does not support FinalizationRegistry.",["invalid-server-app-environment"]:"FirebaseServerApp is not for use in browser environments."},F=new Se("app","Firebase",qo);/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Vo{constructor(t,n,r){this._isDeleted=!1,this._options={...t},this._config={...n},this._name=n.name,this._automaticDataCollectionEnabled=n.automaticDataCollectionEnabled,this._container=r,this.container.addComponent(new L("app",()=>this,"PUBLIC"))}get automaticDataCollectionEnabled(){return this.checkDestroyed(),this._automaticDataCollectionEnabled}set automaticDataCollectionEnabled(t){this.checkDestroyed(),this._automaticDataCollectionEnabled=t}get name(){return this.checkDestroyed(),this._name}get options(){return this.checkDestroyed(),this._options}get config(){return this.checkDestroyed(),this._config}get container(){return this._container}get isDeleted(){return this._isDeleted}set isDeleted(t){this._isDeleted=t}checkDestroyed(){if(this.isDeleted)throw F.create("app-deleted",{appName:this._name})}}function _n(e,t={}){let n=e;typeof t!="object"&&(t={name:t});const r={name:Je,automaticDataCollectionEnabled:!0,...t},s=r.name;if(typeof s!="string"||!s)throw F.create("bad-app-name",{appName:String(s)});if(n||(n=yn()),!n)throw F.create("no-options");const o=de.get(s);if(o){if(Ve(n,o.options)&&Ve(r,o.config))return o;throw F.create("duplicate-app",{appName:s})}const i=new Xs(s);for(const f of Ge.values())i.addComponent(f);const a=new Vo(n,r,i);return de.set(s,a),a}function Ko(e=Je){const t=de.get(e);if(!t&&e===Je&&yn())return _n();if(!t)throw F.create("no-app",{appName:e});return t}function M(e,t,n){var i;let r=(i=jo[e])!=null?i:e;n&&(r+=`-${n}`);const s=r.match(/\s|\//),o=t.match(/\s|\//);if(s||o){const a=[`Unable to register library "${r}" with version "${t}":`];s&&a.push(`library name "${r}" contains illegal characters (whitespace or "/")`),s&&o&&a.push("and"),o&&a.push(`version name "${t}" contains illegal characters (whitespace or "/")`),B.warn(a.join(" "));return}V(new L(`${r}-version`,()=>({library:r,version:t}),"VERSION"))}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const zo="firebase-heartbeat-database",Wo=1,Z="firebase-heartbeat-store";let ve=null;function In(){return ve||(ve=Te(zo,Wo,{upgrade:(e,t)=>{switch(t){case 0:try{e.createObjectStore(Z)}catch(n){console.warn(n)}}}}).catch(e=>{throw F.create("idb-open",{originalErrorMessage:e.message})})),ve}async function Jo(e){try{const n=(await In()).transaction(Z),r=await n.objectStore(Z).get(Rn(e));return await n.done,r}catch(t){if(t instanceof G)B.warn(t.message);else{const n=F.create("idb-get",{originalErrorMessage:t==null?void 0:t.message});B.warn(n.message)}}}async function Pt(e,t){try{const r=(await In()).transaction(Z,"readwrite");await r.objectStore(Z).put(t,Rn(e)),await r.done}catch(n){if(n instanceof G)B.warn(n.message);else{const r=F.create("idb-set",{originalErrorMessage:n==null?void 0:n.message});B.warn(r.message)}}}function Rn(e){return`${e.name}!${e.options.appId}`}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Go=1024,Xo=30;class Yo{constructor(t){this.container=t,this._heartbeatsCache=null;const n=this.container.getProvider("app").getImmediate();this._storage=new Qo(n),this._heartbeatsCachePromise=this._storage.read().then(r=>(this._heartbeatsCache=r,r))}async triggerHeartbeat(){var t,n;try{const s=this.container.getProvider("platform-logger").getImmediate().getPlatformInfoString(),o=Bt();if(((t=this._heartbeatsCache)==null?void 0:t.heartbeats)==null&&(this._heartbeatsCache=await this._heartbeatsCachePromise,((n=this._heartbeatsCache)==null?void 0:n.heartbeats)==null)||this._heartbeatsCache.lastSentHeartbeatDate===o||this._heartbeatsCache.heartbeats.some(i=>i.date===o))return;if(this._heartbeatsCache.heartbeats.push({date:o,agent:s}),this._heartbeatsCache.heartbeats.length>Xo){const i=ei(this._heartbeatsCache.heartbeats);this._heartbeatsCache.heartbeats.splice(i,1)}return this._storage.overwrite(this._heartbeatsCache)}catch(r){B.warn(r)}}async getHeartbeatsHeader(){var t;try{if(this._heartbeatsCache===null&&await this._heartbeatsCachePromise,((t=this._heartbeatsCache)==null?void 0:t.heartbeats)==null||this._heartbeatsCache.heartbeats.length===0)return"";const n=Bt(),{heartbeatsToSend:r,unsentEntries:s}=Zo(this._heartbeatsCache.heartbeats),o=wn(JSON.stringify({version:2,heartbeats:r}));return this._heartbeatsCache.lastSentHeartbeatDate=n,s.length>0?(this._heartbeatsCache.heartbeats=s,await this._storage.overwrite(this._heartbeatsCache)):(this._heartbeatsCache.heartbeats=[],this._storage.overwrite(this._heartbeatsCache)),o}catch(n){return B.warn(n),""}}}function Bt(){return new Date().toISOString().substring(0,10)}function Zo(e,t=Go){const n=[];let r=e.slice();for(const s of e){const o=n.find(i=>i.agent===s.agent);if(o){if(o.dates.push(s.date),xt(n)>t){o.dates.pop();break}}else if(n.push({agent:s.agent,dates:[s.date]}),xt(n)>t){n.pop();break}r=r.slice(1)}return{heartbeatsToSend:n,unsentEntries:r}}class Qo{constructor(t){this.app=t,this._canUseIndexedDBPromise=this.runIndexedDBEnvironmentCheck()}async runIndexedDBEnvironmentCheck(){return En()?Sn().then(()=>!0).catch(()=>!1):!1}async read(){if(await this._canUseIndexedDBPromise){const n=await Jo(this.app);return n!=null&&n.heartbeats?n:{heartbeats:[]}}else return{heartbeats:[]}}async overwrite(t){var r;if(await this._canUseIndexedDBPromise){const s=await this.read();return Pt(this.app,{lastSentHeartbeatDate:(r=t.lastSentHeartbeatDate)!=null?r:s.lastSentHeartbeatDate,heartbeats:t.heartbeats})}else return}async add(t){var r;if(await this._canUseIndexedDBPromise){const s=await this.read();return Pt(this.app,{lastSentHeartbeatDate:(r=t.lastSentHeartbeatDate)!=null?r:s.lastSentHeartbeatDate,heartbeats:[...s.heartbeats,...t.heartbeats]})}else return}}function xt(e){return wn(JSON.stringify({version:2,heartbeats:e})).length}function ei(e){if(e.length===0)return-1;let t=0,n=e[0].date;for(let r=1;r<e.length;r++)e[r].date<n&&(n=e[r].date,t=r);return t}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ti(e){V(new L("platform-logger",t=>new ho(t),"PRIVATE")),V(new L("heartbeat",t=>new Yo(t),"PRIVATE")),M(We,Nt,e),M(We,Nt,"esm2020"),M("fire-js","")}ti("");var ni="firebase",ri="12.0.0";/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */M(ni,ri,"app");const Cn="@firebase/installations",it="0.6.19";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const On=1e4,Dn=`w:${it}`,kn="FIS_v2",si="https://firebaseinstallations.googleapis.com/v1",oi=60*60*1e3,ii="installations",ai="Installations";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const ci={["missing-app-config-values"]:'Missing App configuration value: "{$valueName}"',["not-registered"]:"Firebase Installation is not registered.",["installation-not-found"]:"Firebase Installation not found.",["request-failed"]:'{$requestName} request failed with error "{$serverCode} {$serverStatus}: {$serverMessage}"',["app-offline"]:"Could not process request. Application offline.",["delete-pending-registration"]:"Can't delete installation while there is a pending registration request."},K=new Se(ii,ai,ci);function Nn(e){return e instanceof G&&e.code.includes("request-failed")}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function vn({projectId:e}){return`${si}/projects/${e}/installations`}function Pn(e){return{token:e.token,requestStatus:2,expiresIn:li(e.expiresIn),creationTime:Date.now()}}async function Bn(e,t){const r=(await t.json()).error;return K.create("request-failed",{requestName:e,serverCode:r.code,serverMessage:r.message,serverStatus:r.status})}function xn({apiKey:e}){return new Headers({"Content-Type":"application/json",Accept:"application/json","x-goog-api-key":e})}function ui(e,{refreshToken:t}){const n=xn(e);return n.append("Authorization",fi(t)),n}async function Fn(e){const t=await e();return t.status>=500&&t.status<600?e():t}function li(e){return Number(e.replace("s","000"))}function fi(e){return`${kn} ${e}`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function di({appConfig:e,heartbeatServiceProvider:t},{fid:n}){const r=vn(e),s=xn(e),o=t.getImmediate({optional:!0});if(o){const l=await o.getHeartbeatsHeader();l&&s.append("x-firebase-client",l)}const i={fid:n,authVersion:kn,appId:e.appId,sdkVersion:Dn},a={method:"POST",headers:s,body:JSON.stringify(i)},f=await Fn(()=>fetch(r,a));if(f.ok){const l=await f.json();return{fid:l.fid||n,registrationStatus:2,refreshToken:l.refreshToken,authToken:Pn(l.authToken)}}else throw await Bn("Create Installation",f)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Mn(e){return new Promise(t=>{setTimeout(t,e)})}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function hi(e){return btoa(String.fromCharCode(...e)).replace(/\+/g,"-").replace(/\//g,"_")}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const pi=/^[cdef][\w-]{21}$/,Xe="";function mi(){try{const e=new Uint8Array(17);(self.crypto||self.msCrypto).getRandomValues(e),e[0]=112+e[0]%16;const n=gi(e);return pi.test(n)?n:Xe}catch{return Xe}}function gi(e){return hi(e).substr(0,22)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ae(e){return`${e.appName}!${e.appId}`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ln=new Map;function $n(e,t){const n=Ae(e);Un(n,t),bi(n,t)}function Un(e,t){const n=Ln.get(e);if(!!n)for(const r of n)r(t)}function bi(e,t){const n=wi();n&&n.postMessage({key:e,fid:t}),yi()}let H=null;function wi(){return!H&&"BroadcastChannel"in self&&(H=new BroadcastChannel("[Firebase] FID Change"),H.onmessage=e=>{Un(e.data.key,e.data.fid)}),H}function yi(){Ln.size===0&&H&&(H.close(),H=null)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ei="firebase-installations-database",Si=1,z="firebase-installations-store";let Pe=null;function at(){return Pe||(Pe=Te(Ei,Si,{upgrade:(e,t)=>{switch(t){case 0:e.createObjectStore(z)}}})),Pe}async function he(e,t){const n=Ae(e),s=(await at()).transaction(z,"readwrite"),o=s.objectStore(z),i=await o.get(n);return await o.put(t,n),await s.done,(!i||i.fid!==t.fid)&&$n(e,t.fid),t}async function jn(e){const t=Ae(e),r=(await at()).transaction(z,"readwrite");await r.objectStore(z).delete(t),await r.done}async function _e(e,t){const n=Ae(e),s=(await at()).transaction(z,"readwrite"),o=s.objectStore(z),i=await o.get(n),a=t(i);return a===void 0?await o.delete(n):await o.put(a,n),await s.done,a&&(!i||i.fid!==a.fid)&&$n(e,a.fid),a}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function ct(e){let t;const n=await _e(e.appConfig,r=>{const s=Ti(r),o=Ai(e,s);return t=o.registrationPromise,o.installationEntry});return n.fid===Xe?{installationEntry:await t}:{installationEntry:n,registrationPromise:t}}function Ti(e){const t=e||{fid:mi(),registrationStatus:0};return Hn(t)}function Ai(e,t){if(t.registrationStatus===0){if(!navigator.onLine){const s=Promise.reject(K.create("app-offline"));return{installationEntry:t,registrationPromise:s}}const n={fid:t.fid,registrationStatus:1,registrationTime:Date.now()},r=_i(e,n);return{installationEntry:n,registrationPromise:r}}else return t.registrationStatus===1?{installationEntry:t,registrationPromise:Ii(e)}:{installationEntry:t}}async function _i(e,t){try{const n=await di(e,t);return he(e.appConfig,n)}catch(n){throw Nn(n)&&n.customData.serverCode===409?await jn(e.appConfig):await he(e.appConfig,{fid:t.fid,registrationStatus:0}),n}}async function Ii(e){let t=await Ft(e.appConfig);for(;t.registrationStatus===1;)await Mn(100),t=await Ft(e.appConfig);if(t.registrationStatus===0){const{installationEntry:n,registrationPromise:r}=await ct(e);return r||n}return t}function Ft(e){return _e(e,t=>{if(!t)throw K.create("installation-not-found");return Hn(t)})}function Hn(e){return Ri(e)?{fid:e.fid,registrationStatus:0}:e}function Ri(e){return e.registrationStatus===1&&e.registrationTime+On<Date.now()}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Ci({appConfig:e,heartbeatServiceProvider:t},n){const r=Oi(e,n),s=ui(e,n),o=t.getImmediate({optional:!0});if(o){const l=await o.getHeartbeatsHeader();l&&s.append("x-firebase-client",l)}const i={installation:{sdkVersion:Dn,appId:e.appId}},a={method:"POST",headers:s,body:JSON.stringify(i)},f=await Fn(()=>fetch(r,a));if(f.ok){const l=await f.json();return Pn(l)}else throw await Bn("Generate Auth Token",f)}function Oi(e,{fid:t}){return`${vn(e)}/${t}/authTokens:generate`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function ut(e,t=!1){let n;const r=await _e(e.appConfig,o=>{if(!qn(o))throw K.create("not-registered");const i=o.authToken;if(!t&&Ni(i))return o;if(i.requestStatus===1)return n=Di(e,t),o;{if(!navigator.onLine)throw K.create("app-offline");const a=Pi(o);return n=ki(e,a),a}});return n?await n:r.authToken}async function Di(e,t){let n=await Mt(e.appConfig);for(;n.authToken.requestStatus===1;)await Mn(100),n=await Mt(e.appConfig);const r=n.authToken;return r.requestStatus===0?ut(e,t):r}function Mt(e){return _e(e,t=>{if(!qn(t))throw K.create("not-registered");const n=t.authToken;return Bi(n)?{...t,authToken:{requestStatus:0}}:t})}async function ki(e,t){try{const n=await Ci(e,t),r={...t,authToken:n};return await he(e.appConfig,r),n}catch(n){if(Nn(n)&&(n.customData.serverCode===401||n.customData.serverCode===404))await jn(e.appConfig);else{const r={...t,authToken:{requestStatus:0}};await he(e.appConfig,r)}throw n}}function qn(e){return e!==void 0&&e.registrationStatus===2}function Ni(e){return e.requestStatus===2&&!vi(e)}function vi(e){const t=Date.now();return t<e.creationTime||e.creationTime+e.expiresIn<t+oi}function Pi(e){const t={requestStatus:1,requestTime:Date.now()};return{...e,authToken:t}}function Bi(e){return e.requestStatus===1&&e.requestTime+On<Date.now()}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function xi(e){const t=e,{installationEntry:n,registrationPromise:r}=await ct(t);return r?r.catch(console.error):ut(t).catch(console.error),n.fid}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Fi(e,t=!1){const n=e;return await Mi(n),(await ut(n,t)).token}async function Mi(e){const{registrationPromise:t}=await ct(e);t&&await t}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Li(e){if(!e||!e.options)throw Be("App Configuration");if(!e.name)throw Be("App Name");const t=["projectId","apiKey","appId"];for(const n of t)if(!e.options[n])throw Be(n);return{appName:e.name,projectId:e.options.projectId,apiKey:e.options.apiKey,appId:e.options.appId}}function Be(e){return K.create("missing-app-config-values",{valueName:e})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Vn="installations",$i="installations-internal",Ui=e=>{const t=e.getProvider("app").getImmediate(),n=Li(t),r=ot(t,"heartbeat");return{app:t,appConfig:n,heartbeatServiceProvider:r,_delete:()=>Promise.resolve()}},ji=e=>{const t=e.getProvider("app").getImmediate(),n=ot(t,Vn).getImmediate();return{getId:()=>xi(n),getToken:s=>Fi(n,s)}};function Hi(){V(new L(Vn,Ui,"PUBLIC")),V(new L($i,ji,"PRIVATE"))}Hi();M(Cn,it);M(Cn,it,"esm2020");/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const qi="/firebase-messaging-sw.js",Vi="/firebase-cloud-messaging-push-scope",Kn="BDOU99-h67HcA6JeFXHbSNMu7e2yNNu3RzoMj8TM4W88jITfq7ZmPvIM1Iv-4_l2LxQcYwhqby2xGpWwzjfAnG4",Ki="https://fcmregistrations.googleapis.com/v1",zn="google.c.a.c_id",zi="google.c.a.c_l",Wi="google.c.a.ts",Ji="google.c.a.e",Lt=1e4;var $t;(function(e){e[e.DATA_MESSAGE=1]="DATA_MESSAGE",e[e.DISPLAY_NOTIFICATION=3]="DISPLAY_NOTIFICATION"})($t||($t={}));/**
 * @license
 * Copyright 2018 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except
 * in compliance with the License. You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software distributed under the License
 * is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
 * or implied. See the License for the specific language governing permissions and limitations under
 * the License.
 */var Q;(function(e){e.PUSH_RECEIVED="push-received",e.NOTIFICATION_CLICKED="notification-clicked"})(Q||(Q={}));/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function v(e){const t=new Uint8Array(e);return btoa(String.fromCharCode(...t)).replace(/=/g,"").replace(/\+/g,"-").replace(/\//g,"_")}function Gi(e){const t="=".repeat((4-e.length%4)%4),n=(e+t).replace(/\-/g,"+").replace(/_/g,"/"),r=atob(n),s=new Uint8Array(r.length);for(let o=0;o<r.length;++o)s[o]=r.charCodeAt(o);return s}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const xe="fcm_token_details_db",Xi=5,Ut="fcm_token_object_Store";async function Yi(e){if("databases"in indexedDB&&!(await indexedDB.databases()).map(o=>o.name).includes(xe))return null;let t=null;return(await Te(xe,Xi,{upgrade:async(r,s,o,i)=>{var l;if(s<2||!r.objectStoreNames.contains(Ut))return;const a=i.objectStore(Ut),f=await a.index("fcmSenderId").get(e);if(await a.clear(),!!f){if(s===2){const u=f;if(!u.auth||!u.p256dh||!u.endpoint)return;t={token:u.fcmToken,createTime:(l=u.createTime)!=null?l:Date.now(),subscriptionOptions:{auth:u.auth,p256dh:u.p256dh,endpoint:u.endpoint,swScope:u.swScope,vapidKey:typeof u.vapidKey=="string"?u.vapidKey:v(u.vapidKey)}}}else if(s===3){const u=f;t={token:u.fcmToken,createTime:u.createTime,subscriptionOptions:{auth:v(u.auth),p256dh:v(u.p256dh),endpoint:u.endpoint,swScope:u.swScope,vapidKey:v(u.vapidKey)}}}else if(s===4){const u=f;t={token:u.fcmToken,createTime:u.createTime,subscriptionOptions:{auth:v(u.auth),p256dh:v(u.p256dh),endpoint:u.endpoint,swScope:u.swScope,vapidKey:v(u.vapidKey)}}}}}})).close(),await ke(xe),await ke("fcm_vapid_details_db"),await ke("undefined"),Zi(t)?t:null}function Zi(e){if(!e||!e.subscriptionOptions)return!1;const{subscriptionOptions:t}=e;return typeof e.createTime=="number"&&e.createTime>0&&typeof e.token=="string"&&e.token.length>0&&typeof t.auth=="string"&&t.auth.length>0&&typeof t.p256dh=="string"&&t.p256dh.length>0&&typeof t.endpoint=="string"&&t.endpoint.length>0&&typeof t.swScope=="string"&&t.swScope.length>0&&typeof t.vapidKey=="string"&&t.vapidKey.length>0}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Qi="firebase-messaging-database",ea=1,ee="firebase-messaging-store";let Fe=null;function Wn(){return Fe||(Fe=Te(Qi,ea,{upgrade:(e,t)=>{switch(t){case 0:e.createObjectStore(ee)}}})),Fe}async function ta(e){const t=Jn(e),r=await(await Wn()).transaction(ee).objectStore(ee).get(t);if(r)return r;{const s=await Yi(e.appConfig.senderId);if(s)return await lt(e,s),s}}async function lt(e,t){const n=Jn(e),s=(await Wn()).transaction(ee,"readwrite");return await s.objectStore(ee).put(t,n),await s.done,t}function Jn({appConfig:e}){return e.appId}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const na={["missing-app-config-values"]:'Missing App configuration value: "{$valueName}"',["only-available-in-window"]:"This method is available in a Window context.",["only-available-in-sw"]:"This method is available in a service worker context.",["permission-default"]:"The notification permission was not granted and dismissed instead.",["permission-blocked"]:"The notification permission was not granted and blocked instead.",["unsupported-browser"]:"This browser doesn't support the API's required to use the Firebase SDK.",["indexed-db-unsupported"]:"This browser doesn't support indexedDb.open() (ex. Safari iFrame, Firefox Private Browsing, etc)",["failed-service-worker-registration"]:"We are unable to register the default service worker. {$browserErrorMessage}",["token-subscribe-failed"]:"A problem occurred while subscribing the user to FCM: {$errorInfo}",["token-subscribe-no-token"]:"FCM returned no token when subscribing the user to push.",["token-unsubscribe-failed"]:"A problem occurred while unsubscribing the user from FCM: {$errorInfo}",["token-update-failed"]:"A problem occurred while updating the user from FCM: {$errorInfo}",["token-update-no-token"]:"FCM returned no token when updating the user to push.",["use-sw-after-get-token"]:"The useServiceWorker() method may only be called once and must be called before calling getToken() to ensure your service worker is used.",["invalid-sw-registration"]:"The input to useServiceWorker() must be a ServiceWorkerRegistration.",["invalid-bg-handler"]:"The input to setBackgroundMessageHandler() must be a function.",["invalid-vapid-key"]:"The public VAPID key must be a string.",["use-vapid-key-after-get-token"]:"The usePublicVapidKey() method may only be called once and must be called before calling getToken() to ensure your VAPID key is used."},I=new Se("messaging","Messaging",na);/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function ra(e,t){const n=await dt(e),r=Gn(t),s={method:"POST",headers:n,body:JSON.stringify(r)};let o;try{o=await(await fetch(ft(e.appConfig),s)).json()}catch(i){throw I.create("token-subscribe-failed",{errorInfo:i==null?void 0:i.toString()})}if(o.error){const i=o.error.message;throw I.create("token-subscribe-failed",{errorInfo:i})}if(!o.token)throw I.create("token-subscribe-no-token");return o.token}async function sa(e,t){const n=await dt(e),r=Gn(t.subscriptionOptions),s={method:"PATCH",headers:n,body:JSON.stringify(r)};let o;try{o=await(await fetch(`${ft(e.appConfig)}/${t.token}`,s)).json()}catch(i){throw I.create("token-update-failed",{errorInfo:i==null?void 0:i.toString()})}if(o.error){const i=o.error.message;throw I.create("token-update-failed",{errorInfo:i})}if(!o.token)throw I.create("token-update-no-token");return o.token}async function oa(e,t){const r={method:"DELETE",headers:await dt(e)};try{const o=await(await fetch(`${ft(e.appConfig)}/${t}`,r)).json();if(o.error){const i=o.error.message;throw I.create("token-unsubscribe-failed",{errorInfo:i})}}catch(s){throw I.create("token-unsubscribe-failed",{errorInfo:s==null?void 0:s.toString()})}}function ft({projectId:e}){return`${Ki}/projects/${e}/registrations`}async function dt({appConfig:e,installations:t}){const n=await t.getToken();return new Headers({"Content-Type":"application/json",Accept:"application/json","x-goog-api-key":e.apiKey,"x-goog-firebase-installations-auth":`FIS ${n}`})}function Gn({p256dh:e,auth:t,endpoint:n,vapidKey:r}){const s={web:{endpoint:n,auth:t,p256dh:e}};return r!==Kn&&(s.web.applicationPubKey=r),s}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const ia=7*24*60*60*1e3;async function aa(e){const t=await ua(e.swRegistration,e.vapidKey),n={vapidKey:e.vapidKey,swScope:e.swRegistration.scope,endpoint:t.endpoint,auth:v(t.getKey("auth")),p256dh:v(t.getKey("p256dh"))},r=await ta(e.firebaseDependencies);if(r){if(la(r.subscriptionOptions,n))return Date.now()>=r.createTime+ia?ca(e,{token:r.token,createTime:Date.now(),subscriptionOptions:n}):r.token;try{await oa(e.firebaseDependencies,r.token)}catch(s){console.warn(s)}return jt(e.firebaseDependencies,n)}else return jt(e.firebaseDependencies,n)}async function ca(e,t){try{const n=await sa(e.firebaseDependencies,t),r={...t,token:n,createTime:Date.now()};return await lt(e.firebaseDependencies,r),n}catch(n){throw n}}async function jt(e,t){const r={token:await ra(e,t),createTime:Date.now(),subscriptionOptions:t};return await lt(e,r),r.token}async function ua(e,t){const n=await e.pushManager.getSubscription();return n||e.pushManager.subscribe({userVisibleOnly:!0,applicationServerKey:Gi(t)})}function la(e,t){const n=t.vapidKey===e.vapidKey,r=t.endpoint===e.endpoint,s=t.auth===e.auth,o=t.p256dh===e.p256dh;return n&&r&&s&&o}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ht(e){const t={from:e.from,collapseKey:e.collapse_key,messageId:e.fcmMessageId};return fa(t,e),da(t,e),ha(t,e),t}function fa(e,t){if(!t.notification)return;e.notification={};const n=t.notification.title;n&&(e.notification.title=n);const r=t.notification.body;r&&(e.notification.body=r);const s=t.notification.image;s&&(e.notification.image=s);const o=t.notification.icon;o&&(e.notification.icon=o)}function da(e,t){!t.data||(e.data=t.data)}function ha(e,t){var s,o,i,a,f;if(!t.fcmOptions&&!((s=t.notification)!=null&&s.click_action))return;e.fcmOptions={};const n=(a=(o=t.fcmOptions)==null?void 0:o.link)!=null?a:(i=t.notification)==null?void 0:i.click_action;n&&(e.fcmOptions.link=n);const r=(f=t.fcmOptions)==null?void 0:f.analytics_label;r&&(e.fcmOptions.analyticsLabel=r)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function pa(e){return typeof e=="object"&&!!e&&zn in e}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */ma("AzSCbw63g1R0nCw85jG8","Iaya3yLKwmgvh7cF0q4");function ma(e,t){const n=[];for(let r=0;r<e.length;r++)n.push(e.charAt(r)),r<t.length&&n.push(t.charAt(r));return n.join("")}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ga(e){if(!e||!e.options)throw Me("App Configuration Object");if(!e.name)throw Me("App Name");const t=["projectId","apiKey","appId","messagingSenderId"],{options:n}=e;for(const r of t)if(!n[r])throw Me(r);return{appName:e.name,projectId:n.projectId,apiKey:n.apiKey,appId:n.appId,senderId:n.messagingSenderId}}function Me(e){return I.create("missing-app-config-values",{valueName:e})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class ba{constructor(t,n,r){this.deliveryMetricsExportedToBigQueryEnabled=!1,this.onBackgroundMessageHandler=null,this.onMessageHandler=null,this.logEvents=[],this.isLogServiceStarted=!1;const s=ga(t);this.firebaseDependencies={app:t,appConfig:s,installations:n,analyticsProvider:r}}_delete(){return Promise.resolve()}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function wa(e){try{e.swRegistration=await navigator.serviceWorker.register(qi,{scope:Vi}),e.swRegistration.update().catch(()=>{}),await ya(e.swRegistration)}catch(t){throw I.create("failed-service-worker-registration",{browserErrorMessage:t==null?void 0:t.message})}}async function ya(e){return new Promise((t,n)=>{const r=setTimeout(()=>n(new Error(`Service worker not registered after ${Lt} ms`)),Lt),s=e.installing||e.waiting;e.active?(clearTimeout(r),t()):s?s.onstatechange=o=>{var i;((i=o.target)==null?void 0:i.state)==="activated"&&(s.onstatechange=null,clearTimeout(r),t())}:(clearTimeout(r),n(new Error("No incoming service worker found.")))})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Ea(e,t){if(!t&&!e.swRegistration&&await wa(e),!(!t&&!!e.swRegistration)){if(!(t instanceof ServiceWorkerRegistration))throw I.create("invalid-sw-registration");e.swRegistration=t}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Sa(e,t){t?e.vapidKey=t:e.vapidKey||(e.vapidKey=Kn)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Xn(e,t){if(!navigator)throw I.create("only-available-in-window");if(Notification.permission==="default"&&await Notification.requestPermission(),Notification.permission!=="granted")throw I.create("permission-blocked");return await Sa(e,t==null?void 0:t.vapidKey),await Ea(e,t==null?void 0:t.serviceWorkerRegistration),aa(e)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Ta(e,t,n){const r=Aa(t);(await e.firebaseDependencies.analyticsProvider.get()).logEvent(r,{message_id:n[zn],message_name:n[zi],message_time:n[Wi],message_device_time:Math.floor(Date.now()/1e3)})}function Aa(e){switch(e){case Q.NOTIFICATION_CLICKED:return"notification_open";case Q.PUSH_RECEIVED:return"notification_foreground";default:throw new Error}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function _a(e,t){const n=t.data;if(!n.isFirebaseMessaging)return;e.onMessageHandler&&n.messageType===Q.PUSH_RECEIVED&&(typeof e.onMessageHandler=="function"?e.onMessageHandler(Ht(n)):e.onMessageHandler.next(Ht(n)));const r=n.data;pa(r)&&r[Ji]==="1"&&await Ta(e,n.messageType,r)}const qt="@firebase/messaging",Vt="0.12.23";/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ia=e=>{const t=new ba(e.getProvider("app").getImmediate(),e.getProvider("installations-internal").getImmediate(),e.getProvider("analytics-internal"));return navigator.serviceWorker.addEventListener("message",n=>_a(t,n)),t},Ra=e=>{const t=e.getProvider("messaging").getImmediate();return{getToken:r=>Xn(t,r)}};function Ca(){V(new L("messaging",Ia,"PUBLIC")),V(new L("messaging-internal",Ra,"PRIVATE")),M(qt,Vt),M(qt,Vt,"esm2020")}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Oa(){try{await Sn()}catch{return!1}return typeof window<"u"&&En()&&qs()&&"serviceWorker"in navigator&&"PushManager"in window&&"Notification"in window&&"fetch"in window&&ServiceWorkerRegistration.prototype.hasOwnProperty("showNotification")&&PushSubscription.prototype.hasOwnProperty("getKey")}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Da(e,t){if(!navigator)throw I.create("only-available-in-window");return e.onMessageHandler=t,()=>{e.onMessageHandler=null}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ka(e=Ko()){return Oa().then(t=>{if(!t)throw I.create("unsupported-browser")},t=>{throw I.create("indexed-db-unsupported")}),ot(rt(e),"messaging").getImmediate()}async function Na(e,t){return e=rt(e),Xn(e,t)}function va(e,t){return e=rt(e),Da(e,t)}Ca();const Pa={apiKey:"AIzaSyC88e6TkKcsFnY9ymS5i3RQR4aUlumSnfc",authDomain:"rifavinotinto.firebaseapp.com",projectId:"rifavinotinto",storageBucket:"rifavinotinto.firebasestorage.app",messagingSenderId:"665137785090",appId:"1:665137785090:web:6f8c1a2209e0952a3efa1b",measurementId:"G-FTPZJQHEXQ"},Ba=_n(Pa),Yn=ka(Ba);async function xa(){try{if(await Notification.requestPermission(),Notification.permission==="granted"){const e=await Na(Yn,{vapidKey:"BLRXgajKu-xoq9dhiwsfj43w1tO0iexWbZVFd2tZs_9j91ZyXsBHjR1KOUNagujUOc17eA4jrBt0OAM6XtJHy2w"});console.log("token:: ",e),Fa(e)}Notification.permission==="denied"&&alert("Por favor habilita notificaciones manualmente en ajustes del navegador")}catch(e){console.error("Error en notificaciones:",e)}}function Fa(e){return console.log("subscribing..."),fetch(`https://rifasvinotinto.com/api/toTopic/${e}`,{method:"POST"}).then(t=>{if(!t.ok)throw new Error("Suscripci\xF3n fallida");console.log("Suscrito")})}xa();va(Yn,e=>{console.log("Notificaci\xF3n:",e),new Notification(e.notification.title,{body:e.notification.body,icon:e.notification.icon,data:{url:e.data.url}})});
