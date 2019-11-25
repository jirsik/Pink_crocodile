import React, {useState} from 'react';

const Nav = props => {
    const {setDisplay, loggedIn, setLoggedIn} = {...props}

    const handleNavBtn = (e) => {
        console.log('NAV BTN: ', e.target.id)
        setDisplay(e.target.id)
    }

    const handleLogOut = (e) => {
        setLoggedIn(false)
        setDisplay(null)
        window.localStorage.clear()
    }

    const showOrHide = loggedIn ? {visibility: 'visible'} : {visibility: 'hidden'}
    return (
        <div style={showOrHide}>
            <a className="nav-dropdown nav-btn btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i className="user-icon fas fa-bars"></i>
            </a>
            
            <div className="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a id="" className="dropdown-item" onClick={handleNavBtn}>My History</a>
                <a id="" className="dropdown-item" onClick={handleNavBtn}>Account</a>
                <a id="" className="dropdown-item" onClick={handleLogOut}>Log Out</a>
            </div>
        </div>
    )
}

export default Nav