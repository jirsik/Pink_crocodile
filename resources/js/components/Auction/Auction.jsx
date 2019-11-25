import React, {useState} from 'react';
import Countdown from 'react-countdown-now';

import Bid from '../Bid/Bid.jsx';


const Auction = props => {

    ////////PROPS////////////
    
    // console.log('AUCTION PROPS: ',props)
    const {item, userId, token, getItems, infoDisplay, setInfoDisplay} = {...props}
    
    let current_price
    if(item.bids.length){
        current_price = Math.max(...item.bids.map(bid => bid.price))
    }else{
        current_price = item.minimum_price
    }
    
    const bidData = {
        auction_item_id: item.id,
        user_id: userId,
        current_price: current_price
    }

    let highestBidder
    if(item.user){
        highestBidder = item.user.first_name + ' ' + item.user.last_name
    }else{
        highestBidder = 'no bids'
    }

    //////////////////////////////////////////////////////
                        // DISPLAY //
    ///////////////////////////////////////////////////////


    const handleAboutBtn = () => {
        setInfoDisplay('about')
    }
    const handleBidBtn = () => {
        setInfoDisplay('bid')
    }

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
                <div>{item.item.doner.name}</div>
                <a href={item.item.doner.link}>donor.org</a>
            </div>
        </div>
        </>
    )

    const bidSuccessMessage = (
        <div className='info'>
            <h4>You are the highest bidder</h4>
        </div>
    )
    
    const bidFailedMessage = (
        <div className='info'>
            <h5>You have been outbid :( </h5>
            <h5>Please try again</h5>
        </div>
    )


    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////
    
    // console.log('ITEM: ', item)

    // console.log('END TIME DATE: ', new Date(item.ends_at))
    // console.log('END TIME: ', item.ends_at)

    return (

        <div className="card" style={{maxHeight: '100%', minHeight: '100%'}}>
            <img src={item.item.item_photo_path} className="card-img-top" alt="..."/>
            <div className="card-body" style={{padding: "0.5rem"}}>
                <h5 className="card-title">{item.item.title}</h5>
                <p className="card-text">{item.item.description}</p>
            </div>
            <ul className="list-group list-group-flush" >
                <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                    <i className="fas fa-hourglass-half auction-icon time-icon"></i>
                    <Countdown date={new Date(item.ends_at)}/>
                </div>
                <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                    <i className="fas fa-dollar-sign auction-icon price-icon"></i>
                    <div>{current_price} <strong>CZK</strong></div>
                </div>
                
                {infoDisplay === 'bid' ? <Bid bidData={bidData} token={token} setInfoDisplay={setInfoDisplay} getItems={getItems}/> : infoDisplay === 'about' ? about : infoDisplay === 'bidSuccessMessage' ? bidSuccessMessage : bidFailedMessage}
                
            </ul>

            {infoDisplay === 'bid' || infoDisplay === 'bidSuccessMessage' ? <a className="btn-primary btn" style={{color:'white'}} onClick={handleAboutBtn}>About</a> : <a className="btn-success btn" style={{color:'white'}} onClick={handleBidBtn}>Bid Now</a>}
            
        </div>
    )
}

export default Auction