import React from "react";

import { Link } from "react-router-dom";
function Navbar(){
    return(
    <>
    <div>
        <ul className="flex gap-4">
        <li><Link to='/Login'>Login</Link></li>
       <li> <Link to='/Stock'>Stock</Link></li>
      <li> <Link to='/Signup'>Signup</Link></li>
        </ul>
    </div>
    </>
    )
}
export default Navbar;