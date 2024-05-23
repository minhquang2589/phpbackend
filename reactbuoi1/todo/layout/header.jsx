import React, { useState } from "react";
import "./header.css";

function Header() {
   const [menu, setMenu] = useState([
      "Home",
      "About",
      "Server",
      "Login",
   ]);

   return (
      <div className="row">
         <div className="col-5 d-flex flex-wrap align-items-center">
            <ul  className="list-unstyled d-flex flex-wrap align-items-center">
               <li> <img className="img" src="https://www.svgrepo.com/show/382101/male-avatar-boy-face-man-user.svg" alt="Profie Avatar" /></li>
               <li><h2 className="m-0">Dalya Baron</h2></li>
               <li><p className="m-0">Lorem ipsum dolor sit amet</p></li>
            </ul>
         </div>
         <div className="col-7 ">
            <ul className ="mb-0 list-unstyled d-flex flex-wrap align-items-center justify-content-end ">
               {
                     menu.map((item, index) => (
                     <li key={index}>{item}</li>
                  ))
               }
            </ul>
         </div>
      </div>
   );
}

export default Header;
