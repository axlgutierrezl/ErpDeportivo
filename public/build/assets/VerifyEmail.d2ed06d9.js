import{g as p,d as _,f as n,b as e,u as t,w as s,F as h,o as l,H as y,j as g,a as o,n as v,k as a,L as d,q as x}from"./app.50683a97.js";import{A as b}from"./AuthenticationCard.b93f5d08.js";import{_ as k}from"./AuthenticationCardLogo.525a2bc5.js";import{_ as w}from"./PrimaryButton.9fad14d4.js";import"./_plugin-vue_export-helper.cdc0426e.js";const V=o("div",{class:"mb-4 text-sm text-gray-600"}," Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1),E={key:0,class:"mb-4 font-medium text-sm text-green-600"},B=["onSubmit"],C={class:"mt-4 flex items-center justify-between"},H={__name:"VerifyEmail",props:{status:String},setup(c){const m=c,i=p(),u=()=>{i.post(route("verification.send"))},f=_(()=>m.status==="verification-link-sent");return(r,L)=>(l(),n(h,null,[e(t(y),{title:"Email Verification"}),e(b,null,{logo:s(()=>[e(k)]),default:s(()=>[V,t(f)?(l(),n("div",E," A new verification link has been sent to the email address you provided in your profile settings. ")):g("",!0),o("form",{onSubmit:x(u,["prevent"])},[o("div",C,[e(w,{class:v({"opacity-25":t(i).processing}),disabled:t(i).processing},{default:s(()=>[a(" Resend Verification Email ")]),_:1},8,["class","disabled"]),o("div",null,[e(t(d),{href:r.route("profile.show"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:s(()=>[a(" Edit Profile")]),_:1},8,["href"]),e(t(d),{href:r.route("logout"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 ml-2"},{default:s(()=>[a(" Log Out ")]),_:1},8,["href"])])])],40,B)]),_:1})],64))}};export{H as default};
