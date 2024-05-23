import React, { useState } from 'react';

function Footer (){

   const [footerLink, setFooterLink] = useState([
      {
         'Title': 'Email',
         'Description': 'rights@gmail.com'
      },
      {
         'Title': 'Github',
         'Description': 'Github Quang'
      },
      {
         'Title': 'ADAMs Follow',
         'Description': 'Lorem ipsum dolor sit amet '
      },
      {
         'Title': '',
         'Description': '@copy rights@gmail.com'
      }
   ]);

   return (
      <div className="row">
         {
            footerLink.map((item, index) => {
               return (
                  <div key={index} className='col-3'> 
                     <h4>{item.Title}</h4>
                     <p>{item.Description}</p>
                  </div>
               );
            })
         }
      </div>
   );
               }
export default Footer;