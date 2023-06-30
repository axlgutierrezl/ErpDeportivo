import{h as m,s as k,c as g,w as o,z as A,o as l,b as a,q as V,k as y,a as e,f as u,l as C,t as r,F as w}from"./app.50683a97.js";import{T as B}from"./TenantLayout.4c67b316.js";import{C as D}from"./CardView.5dc7dcb1.js";import{_ as T}from"./AddEditAlmacen.520f03c1.js";import{V as E}from"./VBreadcrumbs.c34b1911.js";import{V as p,g as L}from"./index.4549214f.js";import{V as N}from"./VTable.b15a6983.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./VNavigationDrawer.8088819a.js";import"./DialogFormModal.e18ee1c1.js";import"./VForm.9f532f63.js";import"./VTextField.65545f13.js";import"./VDialog.52eddf4b.js";const I=e("thead",{class:"text-uppercase bg-thead-primary"},[e("tr",null,[e("th",{class:"text-center"},"Nombre"),e("th",{class:"text-center"},"Ubicacion"),e("th",{class:"text-center"},"Fecha creaci\xF3n"),e("th",{class:"text-center"},"N\xB0 Productos"),e("th",{class:"text-center"},"estado"),e("th",{class:"text-center"},"Acciones")])],-1),$={class:"text-center"},z={class:"text-center"},F={class:"text-center"},M={class:"text-center"},U={class:"text-center"},S={class:"text-center"},q={key:1},P=e("td",{colspan:"6",class:"text-center"},[e("strong",null,"No hay registros")],-1),j=[P],se={__name:"AlmacenIndex",props:["flash","almacenes"],setup(h){const x=h,n=m(!1),i=m([]),c=m({id:0,descripcion:"",ubicacion:""});function d(f,s={}){switch(f){case"ADD":{n.value=!0;break}case"EDIT":{n.value=!0,c.value.id=s.id,c.value.descripcion=s.descripcion,c.value.ubicacion=s.ubicacion;break}}}function _(){A.Inertia.reload({only:["almacenes"],onSuccess:()=>{i.value=x.almacenes}})}return k(()=>{_()}),(f,s)=>(l(),g(B,{title:"Almacen",titleBread:"Listado de almacenes"},{itemBreadCrumb:o(()=>[a(E,{items:["Almacen","Almacenes","Lista"],class:"pa-0"})]),default:o(()=>[a(D,null,{title:o(()=>[a(p,{class:"float-right",color:"teal-darken-2",onClick:s[0]||(s[0]=V(t=>d("ADD"),["prevent"]))},{default:o(()=>[a(L,{icon:"mdi:mdi-plus"}),y(" Agregar ")]),_:1})]),content:o(()=>[a(N,{density:"comfortable",hover:""},{default:o(()=>[I,e("tbody",null,[i.value.length>0?(l(!0),u(w,{key:0},C(i.value,(t,v)=>(l(),u("tr",{key:v},[e("td",$,r(t.descripcion),1),e("td",z,r(t.ubicacion),1),e("td",F,r(t.fecha_creacion),1),e("td",M,r(t.total_productos),1),e("td",U,r(t.estado),1),e("td",S,[a(p,{onClick:b=>d("EDIT",t),icon:"mdi:mdi-pencil",color:"success",size:"x-small",class:"mr-1"},null,8,["onClick"]),a(p,{onClick:b=>d("DELETE",t),icon:"mdi:mdi-delete",color:"red",size:"x-small",class:"ml-1"},null,8,["onClick"])])]))),128)):(l(),u("tr",q,j))])]),_:1})]),_:1}),a(T,{show:n.value,"onUpdate:show":s[1]||(s[1]=t=>n.value=t),onAddingAlmacen:_,formulario:c.value,"onUpdate:formulario":s[2]||(s[2]=t=>c.value=t)},null,8,["show","formulario"])]),_:1}))}};export{se as default};