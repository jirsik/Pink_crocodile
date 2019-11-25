import React from 'react';

const ContainerBtns = props => {
    const {setDisplayTypeBtn, display, loggedIn} = props

    return (
        <div className="container-btns">
            <div className={`container-btn btn ${display === 'show' ? 'current-btn' : 'silent-btn'}`}>
                <i id="show" className="far fa-circle" onClick={setDisplayTypeBtn}></i>
            </div>
            <div className={`container-btn btn ${display === 'list' ? 'current-btn' : 'silent-btn'}`} >
                <i id="list" className="fas fa-chart-line" onClick={setDisplayTypeBtn}></i>
            </div>
            <div className={`container-btn btn ${display === 'myBids' || display === 'logIn' ? 'current-btn' : 'silent-btn'}`} style={{backgroundColor: !loggedIn && '#428bca'}}>
                {loggedIn ? <i id="myBids" className="fas fa-user-tag" onClick={setDisplayTypeBtn}/> : <i id="logIn" className="fas fa-user-alt" onClick={setDisplayTypeBtn}/>}
            </div>
        </div>
    )
}

export default ContainerBtns;