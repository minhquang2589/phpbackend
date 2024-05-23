import "./main.css";
function Main (){
   return (
      <>
         <div className="main-warp">
         <div className="row">
            <div className="col-4">
               <img src="https://www.svgrepo.com/show/382101/male-avatar-boy-face-man-user.svg" alt="Profie Avatar" />
            </div>
            <div className="col-8">
               <ul className="list-unstyled">
                  <li><h3>A Bit About Me!</h3></li>
                  <li> <strong>Lorem ipsun doler sit amet consecturer adisiping elit </strong></li>
                  <li> <p>Lorem ipsun doler sit amet consecturer adisiping <br/>
                  elit. Corppi qui obcaecati magni laudantium minus <br/> 
                  cupidicati natus, tempora eaque facere in titate <br/> 
                  corporis aut non eligendi error eveniet. Redudiandae <br/> 
                  molestiae alias !
                  </p></li>
                  <li>
                      <div>
                        <ul className="list-unstyled text-center d-flex flex-wrap align-items-center">
                           <li className="li1">Resume</li>
                           <li className="li2">Research</li>
                           <li className="li3">Outreach</li>
                           <li className="li4">Personal</li>
                        </ul>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <hr />
      </>
      
   );
}
export default Main;