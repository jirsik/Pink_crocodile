import React, {useState} from 'react';
import Bid from '../Bid/Bid.jsx';
import Countdown from 'react-countdown-now';

import formatNumber from '../../helpers/formatNumber';


const MyBid = props => {
    const {item, bid, token, getItems, user, setCurrentItemId, setDisplay} = {...props}
    const [infoDisplay, setInfoDisplay] = useState('about')

    
    const handleSeeItemBtn = (e) => {
        setCurrentItemId(e.target.id - 1)
        setDisplay('show')
    }

    const handleBidBtn = (e) => {
        setInfoDisplay('bid')
    }
    const handleBackBtn = (e) => {
        setInfoDisplay('about')
    }

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

    //Check if auction has ended

    if(Date.now() < new Date(item.ends_at)){
        showItemBtn = <div id={item.id} className="btn btn-primary" onClick={handleSeeItemBtn}>See Item</div>
        bidBtn = <a className="btn-success btn" style={{color:'white'}} onClick={handleBidBtn}>Bid Now</a>
    }else if(Date.now() > new Date(item.ends_at) && item.user.id === user.id){
        showItemBtn = <h6>Congrats you won this item!</h6>
        bidBtn = null
    }else if(Date.now() > new Date(item.ends_at) && item.user.id !== user.id){
        showItemBtn = <h6>Sorry, you didn't win this item :(</h6>
        bidBtn = null
    }else{
        showItemBtn = null
        bidBtn = null
    }

    //Data for Bid
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
    if(item.user.first_name === user.first_name && item.user.last_name === user.last_name){
        highestBidder = 'You are the highest bidder!'
    }else{
        highestBidder = item.user.first_name + ' ' + item.user.last_name
    }

    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////

    let showItemBtn, bidBtn
    const backBtn = <div className="btn btn-warning" onClick={handleBackBtn}>Back</div>
    const highlight = user.id == item.user.id ? {border: '5px solid rgba(0, 128, 0, 0.4)'} : {border: '5px solid rgba(255, 0, 0, 0.4)'}

    return (
        <div key={bid.id} className="bid" style={highlight}>
            {/* HEAD */}
            <div className="list-group-item" style={{display: 'flex', justifyContent: 'flex-end', alignItems: 'center'}}>
                <h4>{item.item.title}</h4>
            </div>
            <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                <i className="fas fa-dollar-sign auction-icon price-icon"></i>
                <div>{formatNumber(current_price)} <strong>CZK</strong></div>
            </div>
            {/* INFO DISPLAY */}
            {infoDisplay === 'bid' ? <Bid bidData={bidData} token={token} setInfoDisplay={setInfoDisplay} getItems={getItems}/> : infoDisplay === 'bidSuccessMessage' ? bidSuccessMessage : infoDisplay === 'bidFailedMessage' ? bidFailedMessage :
                <>
                <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                    <i className="fas fa-user-tag auction-icon pink"></i>
                    <div>{formatNumber(bid.price)} <strong>CZK</strong></div>
                </div>
                <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                    <i className="fas fa-gavel highest-bidder-icon action-icon"></i>
                    <div>{highestBidder}</div>
                </div>
                <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                    <i className="fas fa-clock auction-icon"></i>
                    {/* <div>{bid.created_at}</div> */}
                    <Countdown date={new Date(item.ends_at)}/>
                </div>
                </>
            }
            {/* BTNS */}
            <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                {infoDisplay === 'bid' ?  backBtn : showItemBtn}
                {infoDisplay !== 'bid' && bidBtn}
            </div>
        </div>
    )
}

export default MyBid;