import React, {useState} from 'react';
import Countdown from 'react-countdown-now';

import Bid from '../Bid/Bid.jsx';

import formatNumber from '../../helpers/formatNumber';


const Auction = props => {

    ////////PROPS////////////
    
    console.log('AUCTION PROPS: ',props)
    const {item, user, token, getItems, infoDisplay, setInfoDisplay, loggedIn, setDisplay} = {...props}
    
    let current_price
    if(item.bids.length){
        current_price = Math.max(...item.bids.map(bid => bid.price))
    }else{
        current_price = item.minimum_price
    }
    
    const bidData = {
        auction_item_id: item.id,
        user_id: user.id,
        current_price: current_price
    }

    let highestBidder
    if(!item.user){
        highestBidder = 'No Bids'
    }else if(item.user.first_name === user.first_name && item.user.last_name === user.last_name){
        highestBidder = 'You are the highest bidder!'
    }else{
        highestBidder = item.user.first_name + ' ' + item.user.last_name
    }

    //////////////////////////////////////////////////////
                        // BTNS //
    ///////////////////////////////////////////////////////

    //ABOUT BTN
    const handleAboutBtn = () => {
        setInfoDisplay('about')
    }
    const aboutBtn = (
        <a className="btn-primary btn main-btn" style={{color:'white'}} onClick={handleAboutBtn}>About</a>
    )
    //BID BTN
    const handleBidBtn = () => {
        setInfoDisplay('bid')
    }
    const bidBtn = (
        <a className="btn-success btn main-btn" style={{color:'white'}} onClick={handleBidBtn}>Bid Now</a>
    )

    //REGISTER BTN
    const handleRegisterBtn = () => {
        setDisplay('logIn')
    }
    const registerBtn = (
        <a className="btn-primary btn main-btn" style={{color:'white'}} onClick={handleRegisterBtn}>Log in to bid</a>
    )

    //BID ENDED BTN
    const bidEndedBtn = (
        <a className="btn-danger btn main-btn" style={{color:'white'}}>Auction has ended</a>
    )

    //////////////////////////////////////////////////////
                        // DISPLAY //
    ///////////////////////////////////////////////////////

    //ABOUT
    const about = (
        <>
        <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between'}}>
            <i className="fas fa-gavel highest-bidder-icon action-icon"></i>
            <div>{highestBidder}</div>
        </div>
        <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
            <div>
                <i className="fas fa-hand-holding-heart donor-icon action-icon"></i>
            </div>
            <div className="donor-info">
                {/* <div>{item.item.doner.name}</div> */}
                <div>{item.item.doner ? item.item.doner.name : 'Anonymous'}</div>
                <a href={item.item.doner && item.item.doner.link ? item.item.doner.link : null}>{item.item.doner && item.item.doner.link ? item.item.doner.link.replace(/^(https?:\/\/)?(www\.)?/i, '') : null}</a>
            </div>
        </div>
        </>
    )
    //BID SUCCESS
    const bidSuccessMessage = (
        <div className='info'>
            <h4>You are the highest bidder</h4>
        </div>
    )
    //BID FAILED
    const bidFailedMessage = (
        <div className='info'>
            <h5>You have been outbid :( </h5>
            <h5>Please try again</h5>
        </div>
    )


    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////

    console.log('ITEM: ', item)
    // console.log('ITEM ENDS AT: ', item.ends_at)
    // console.log('USER: ', user)

    const listGroupItemStyle = {display: 'flex', justifyContent: 'space-between', alignItems: 'center'}

    return (

        <div className="card" style={{maxHeight: '100%', minHeight: '100%'}}>
            <img src={item.item.item_photo_path} className="card-img-top" alt="..."/>
            <div className="card-body" style={{padding: "0.5rem"}}>
                <h3 className="card-title auction-item-title">{item.item.title}</h3>
                <p className="card-text">{item.item.description}</p>
            </div>
            <ul className="list-group list-group-flush" >
                <div className="list-group-item" style={listGroupItemStyle}>
                    <i className="fas fa-hourglass-half auction-icon time-icon"></i>
                    <Countdown date={new Date(item.ends_at)}/>
                </div>
                <div className="list-group-item" style={listGroupItemStyle}>
                    <i className="fas fa-dollar-sign auction-icon price-icon"></i>
                    <div>{formatNumber(current_price)} <strong>CZK</strong></div>
                </div>
                
                {infoDisplay === 'bid' ? <Bid bidData={bidData} token={token} setInfoDisplay={setInfoDisplay} getItems={getItems}/> : infoDisplay === 'about' ? about : infoDisplay === 'bidSuccessMessage' ? bidSuccessMessage : bidFailedMessage}
                
            </ul>

            {Date.now() > new Date(item.ends_at) ? bidEndedBtn : !loggedIn ? registerBtn : infoDisplay === 'bid' || infoDisplay === 'bidSuccessMessage' ? aboutBtn : bidBtn}
            
        </div>
    )
}

export default Auction