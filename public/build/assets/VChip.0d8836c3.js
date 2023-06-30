import{C as P,ak as K,Z as A,_ as B,aj as N,K as C,b as a,U as g,G as O,e as I,a2 as q,y as H}from"./app.50683a97.js";import{a7 as J,v as _,C as G,a8 as M,f as U,R as X,H as Z,h as Q,J as W,a9 as Y,A as ee,K as le,B as ae,O as te,D as se,i as ne,P as ie,E as oe,F as ue,aa as de,N as ce,G as re,w as u,p as ve,g as d}from"./index.4549214f.js";import{j as S}from"./VNavigationDrawer.8088819a.js";const x=Symbol.for("vuetify:v-chip-group");P({name:"VChipGroup",props:{column:Boolean,filter:Boolean,valueComparator:{type:Function,default:K},...J({selectedClass:"v-chip--selected"}),..._(),...A(),...G({variant:"tonal"})},emits:{"update:modelValue":e=>!0},setup(e,c){let{slots:s}=c;const{themeClasses:r}=B(e),{isSelected:t,select:v,next:f,prev:p,selected:m}=M(e,x);return N({VChip:{color:C(e,"color"),filter:C(e,"filter"),variant:C(e,"variant")}}),U(()=>{var n;return a(e.tag,{class:["v-chip-group",{"v-chip-group--column":e.column},r.value]},{default:()=>[(n=s.default)==null?void 0:n.call(s,{isSelected:t,select:v,next:f,prev:p,selected:m.value})]})}),{}}});const he=P({name:"VChip",directives:{Ripple:X},props:{activeClass:String,appendAvatar:String,appendIcon:g,closable:Boolean,closeIcon:{type:g,default:"$delete"},closeLabel:{type:String,default:"$vuetify.close"},draggable:Boolean,filter:Boolean,filterIcon:{type:String,default:"$complete"},label:Boolean,link:Boolean,pill:Boolean,prependAvatar:String,prependIcon:g,ripple:{type:Boolean,default:!0},text:String,modelValue:{type:Boolean,default:!0},...Z(),...Q(),...W(),...Y(),...ee(),...le(),...ae(),..._({tag:"span"}),...A(),...G({variant:"tonal"})},emits:{"click:close":e=>!0,"update:active":e=>!0,"update:modelValue":e=>!0,"group:selected":e=>!0},setup(e,c){let{attrs:s,emit:r,slots:t}=c;const{borderClasses:v}=te(e),{colorClasses:f,colorStyles:p,variantClasses:m}=se(e),{densityClasses:n}=ne(e),{elevationClasses:D}=ie(e),{roundedClasses:R}=oe(e),{sizeClasses:$}=ue(e),{themeClasses:E}=B(e),k=O(e,"modelValue"),l=de(e,x,!1),h=ce(e,s);function T(i){k.value=!1,r("click:close",i)}return()=>{var i;const z=h.isLink.value?"a":e.tag,F=!!(t.append||e.appendIcon||e.appendAvatar),w=!!(t.close||e.closable),V=!!(t.filter||e.filter)&&l,L=!!(t.prepend||e.prependIcon||e.prependAvatar),b=!l||l.isSelected.value,o=!e.disabled&&(!!l||h.isClickable.value||e.link),j=e.link?e.link:l==null?void 0:l.toggle;return k.value&&I(a(z,{class:["v-chip",{"v-chip--disabled":e.disabled,"v-chip--label":e.label,"v-chip--link":o,"v-chip--filter":V,"v-chip--pill":e.pill},E.value,v.value,b?f.value:void 0,n.value,D.value,R.value,$.value,m.value,l==null?void 0:l.selectedClass.value],style:[b?p.value:void 0],disabled:e.disabled||void 0,draggable:e.draggable,href:h.href.value,onClick:o&&j},{default:()=>{var y;return[re(o,"v-chip"),V&&a(u,{key:"filter",defaults:{VIcon:{icon:e.filterIcon}}},{default:()=>[a(ve,null,{default:()=>[I(a("div",{class:"v-chip__filter"},[t.filter?t.filter():a(d,null,null)]),[[H,l.isSelected.value]])]})]}),L&&a(u,{key:"prepend",defaults:{VAvatar:{image:e.prependAvatar},VIcon:{icon:e.prependIcon}}},{default:()=>[t.prepend?a("div",{class:"v-chip__prepend"},[t.prepend()]):e.prependAvatar?a(S,{start:!0},null):e.prependIcon?a(d,{start:!0},null):void 0]}),(y=(i=t.default)==null?void 0:i.call(t,{isSelected:l==null?void 0:l.isSelected.value,selectedClass:l==null?void 0:l.selectedClass.value,select:l==null?void 0:l.select,toggle:l==null?void 0:l.toggle,value:l==null?void 0:l.value.value,disabled:e.disabled}))!=null?y:e.text,F&&a(u,{key:"append",defaults:{VAvatar:{image:e.appendAvatar},VIcon:{icon:e.appendIcon}}},{default:()=>[t.append?a("div",{class:"v-chip__append"},[t.append()]):e.appendAvatar?a(S,{end:!0},null):e.appendIcon?a(d,{end:!0},null):void 0]}),w&&a(u,{key:"close",defaults:{VIcon:{icon:e.closeIcon,size:"x-small"}}},{default:()=>[a("div",{class:"v-chip__close",onClick:T},[t.close?t.close():a(d,null,null)])]})]}}),[[q("ripple"),o&&e.ripple,null]])}}});export{he as V};