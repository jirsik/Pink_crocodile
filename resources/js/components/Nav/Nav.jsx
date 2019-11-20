import React, {useState} from 'react';

const Nav = props => {
    return (
        <>
        <a className="nav-dropdown nav-btn btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i className="user-icon fas fa-bars"></i>
        </a>
        
        <div className="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a className="dropdown-item" href="#">My Bids</a>
            <a className="dropdown-item" href="#">My History</a>
            <a className="dropdown-item" href="#">Account</a>
            <a className="dropdown-item" href="#">Log Out</a>
        </div>
        </>
    )
}

export default Nav