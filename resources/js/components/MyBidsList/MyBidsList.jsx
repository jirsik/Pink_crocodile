import React, {useState, useEffect} from 'react';
import MyBid from '../MyBid/MyBid.jsx';

const MyBidsList = props => {
    const {items, user, token, setCurrentItemId, setDisplay, getItems} = {...props}

    // console.log('MY BIDS ITEMS: ', items)

     //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////
    
    return (
        
        <div className="items-list">
            <div className="title-container">
                {/* <img className="title-img" src="../images/logo.svg"></img> */}
                <div className="title-img"/>
                <h1 className="pink">My Bids</h1>
            </div>

            {items.map((item, i) => {
                
                const topBid = item.bids.filter(bid => bid.user_id == user.id).sort((a,b) => new Date(b.created_at) - new Date(a.created_at))[0]
                return topBid && <MyBid key={i} item={item} bid={topBid} token={token} getItems={getItems} user={user} setCurrentItemId={setCurrentItemId} setDisplay={setDisplay} />

            })}

        </div>

    )
}

export default MyBidsList;