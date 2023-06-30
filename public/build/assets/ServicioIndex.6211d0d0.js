import{aO as C,h as _,p as S,o as p,c as k,w as s,k as w,t as n,b as l,i as E,s as D,z as B,q as N,a,f as V,l as T,F as I}from"./app.50683a97.js";import{T as L}from"./TenantLayout.4c67b316.js";import{C as O}from"./CardView.5dc7dcb1.js";import{_ as $}from"./DialogFormModal.e18ee1c1.js";import{a as y,b,V as h,g as M}from"./index.4549214f.js";import{V as q}from"./VTextField.65545f13.js";import{V as P}from"./VSelect.1e68f7fa.js";import{V as U}from"./VBreadcrumbs.c34b1911.js";import{V as F}from"./VTable.b15a6983.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./VNavigationDrawer.8088819a.js";import"./VForm.9f532f63.js";import"./VDialog.52eddf4b.js";import"./VCheckboxBtn.fafb4134.js";import"./VChip.0d8836c3.js";const z={__name:"AddEditServicio",props:{show:{type:Boolean,required:!1,default:!1},formulario:{type:Object,default:()=>null},timeout:{type:Number,default:1e3}},emits:["addingServicio","update:show","update:formulario"],setup(f,{emit:u}){const i=f,d=C(),e=_({id:0,nombre:"",precio:"",estado_alquiler:null,processing:!1,errors:{nombre:"",precio:"",estado_alquiler:""}});async function c(){try{e.value.processing=!0;let r=e.value.id==0?route("tenant.almacen.servicios.store"):route("tenant.almacen.servicios.update",{servicio:e.value.id});const o=e.value.id==0?"post":"put",{data:t}=await axios[o](r,e.value),{errors:g,success:A,message:x}=t;if(!A)throw{message:x,errors:g};d.success(x,{timeout:1e3}),u("addingServicio"),m()}catch(r){e.value.processing=!1,r.errors&&v(r.errors)}}S(i,r=>{r.formulario&&(e.value.id=r.formulario.id,e.value.nombre=r.formulario.nombre,e.value.precio=r.formulario.precio,e.value.estado_alquiler=r.formulario.estado_alquiler)});function v(r){for(let o in e.value.errors)r.hasOwnProperty(o)&&(e.value.errors[o]=r[o][0]),r.hasOwnProperty(o)||(e.value.errors[o]="")}function m(){u("update:show",!1),e.value={id:0,nombre:"",precio:"",estado_alquiler:"",processing:!1,errors:{nombre:"",precio:"",estado_alquiler:""}},u("update:formulario",null)}return(r,o)=>(p(),k($,{show:f.show,"onUpdate:show":o[3]||(o[3]=t=>E(show)?show.value=t:null),onSubmitted:c,onClose:m,processing:e.value.processing,maxWidth:450},{title:s(()=>[w(n(e.value.id==0?"Nuevo servicio":"Editar servicio"),1)]),content:s(()=>[l(y,null,{default:s(()=>[l(b,{cols:"12",md:"12"},{default:s(()=>[l(q,{label:"Nombre","error-messages":e.value.errors.nombre,variant:"outlined",density:"comfortable",modelValue:e.value.nombre,"onUpdate:modelValue":o[0]||(o[0]=t=>e.value.nombre=t)},null,8,["error-messages","modelValue"])]),_:1})]),_:1}),l(y,null,{default:s(()=>[l(b,{cols:"12",md:"6"},{default:s(()=>[l(q,{label:"Precio","error-messages":e.value.errors.precio,variant:"outlined",density:"comfortable",modelValue:e.value.precio,"onUpdate:modelValue":o[1]||(o[1]=t=>e.value.precio=t)},null,8,["error-messages","modelValue"])]),_:1}),l(b,{cols:"12",md:"6"},{default:s(()=>[l(P,{"error-messages":e.value.errors.estado_alquiler,label:"Alquiler",items:["CAMPO NOCHE","CAMPO DIA","ACADEMIA"],variant:"outlined",density:"comfortable",modelValue:e.value.estado_alquiler,"onUpdate:modelValue":o[2]||(o[2]=t=>e.value.estado_alquiler=t)},null,8,["error-messages","modelValue"])]),_:1})]),_:1})]),actions:s(()=>[l(h,{type:"submit"},{default:s(()=>[w(n(e.value.id==0?"Guardar":"Editar"),1)]),_:1})]),_:1},8,["show","processing"]))}},G=a("thead",{class:"text-uppercase bg-thead-primary text-center"},[a("tr",null,[a("th",null,"Nombre"),a("th",null,"Precio"),a("th",null,"Alquiler"),a("th",null,"Fecha creaci\xF3n"),a("th",null,"Acciones")])],-1),R={class:"text-center"},j={class:"text-center"},H={class:"text-center"},W={key:1},J=a("td",{colspan:"5",class:"text-center"},[a("strong",null,"No hay registros")],-1),K=[J],ce={__name:"ServicioIndex",props:["servicios"],setup(f){const u=f,i=_(!1),d=_(null),e=_([]);function c(m,r={}){switch(m){case"ADD":{i.value=!0;break}case"EDIT":{i.value=!0,d.value={id:r.id,nombre:r.nombre,precio:r.precio,estado_alquiler:r.estado_alquiler};break}}}function v(){B.Inertia.reload({only:["servicios"],onSuccess:()=>{e.value=u.servicios}})}return D(()=>{v()}),(m,r)=>(p(),k(L,{title:"Servicios",titleBread:"Listado de servicios"},{itemBreadCrumb:s(()=>[l(U,{items:["Almacen","Servicios","Lista"],class:"pa-0"})]),default:s(()=>[l(O,null,{title:s(()=>[l(y,null,{default:s(()=>[l(b,{cols:"12",md:"12"},{default:s(()=>[l(h,{class:"float-right",color:"teal-darken-2",onClick:r[0]||(r[0]=N(o=>c("ADD"),["prevent"]))},{default:s(()=>[l(M,{icon:"mdi:mdi-plus"}),w(" Agregar ")]),_:1})]),_:1})]),_:1})]),content:s(()=>[l(F,{density:"comfortable",hover:""},{default:s(()=>[G,a("tbody",null,[e.value.length>0?(p(!0),V(I,{key:0},T(e.value,(o,t)=>(p(),V("tr",{key:t},[a("td",null,n(o.nombre),1),a("td",R,n(o.precio),1),a("td",j,n(o.estado_alquiler),1),a("td",H,n(o.fecha_creacion),1),a("td",null,[l(h,{onClick:g=>c("EDIT",o),icon:"mdi:mdi-pencil",color:"success",size:"x-small",class:"mr-1"},null,8,["onClick"]),l(h,{onClick:g=>c("DELETE",o),icon:"mdi:mdi-delete",color:"red",size:"x-small",class:"ml-1"},null,8,["onClick"])])]))),128)):(p(),V("tr",W,K))])]),_:1})]),_:1}),l(z,{show:i.value,"onUpdate:show":r[1]||(r[1]=o=>i.value=o),onAddingServicio:v,formulario:d.value,"onUpdate:formulario":r[2]||(r[2]=o=>d.value=o)},null,8,["show","formulario"])]),_:1}))}};export{ce as default};
