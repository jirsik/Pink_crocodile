import React, {useState, useEffect} from 'react';
import Bid from '../Bid/Bid.jsx';

const MyBids = props => {
    // const [myBids, setMyBids] = useState([])
    const {items, userId, token, setCurrentItemId, setDisplay, infoDisplay, setInfoDisplay} = {...props}

    //Get bids
    // const getBids = () => {
    //     fetch(`/api/myBids/${userId}`, {
    //         method: 'GET',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'Authorization': 'Bearer '+ token,
    //             'Accept' : 'application/json'
    //         },
    //     })
    //     .then((response) => response.json())
    //     .then((response) => {
    //         console.log('RESPONSE: ', response)
    //         setMyBids(response)
    //     })
    // }

    const handleSeeItemBtn = (e) => {
        setCurrentItemId(e.target.id - 1)
        setDisplay('show')
    }

    const handleBidBtn = (e) => {
        setInfoDisplay('bid')
    }

    /////////////////////////////////////////////////////
                    //COMP DID MOUNT//
    ////////////////////////////////////////////////////

    // useEffect(() => {
    //     getBids()
    // },[])

    // console.log('MY BIDS: ', myBids)

     //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////

    let showItemBtn, bidBtn

    
    return (
        <div className="items-list">
            <h1 style={{color: "rgba(214, 0, 110)"}}>My Bids</h1>
            {myBids.message ? <h2>{myBids.message}</h2> : items.map(item => {
                console.log('MY BIDS ITEM: ',item)
                if(item.user.id === userId){
                    return (
                        <div key={bid.id} className="bid" style={{margin: '1rem'}}>
                            <div className="list-group-item" style={{display: 'flex', justifyContent: 'flex-end', alignItems: 'center'}}>
                                <h5>{bid.auction_item.item.title}</h5>
                            </div>
                            <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                                <i className="fas fa-dollar-sign auction-icon price-icon"></i>
                                <div>{bid.price} <strong>CZK</strong></div>
                            </div>
                            {infoDisplay === 'bid' ? <Bid bidData={bidData} token={token} setInfoDisplay={setInfoDisplay} getItems={getItems}/> :
                            <>
                            <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                                <i className="fas fa-gavel highest-bidder-icon action-icon"></i>
                                <div>{bid.auction_item.user.first_name + ' ' + bid.auction_item.user.last_name}</div>
                            </div>
                            <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                                <i className="fas fa-clock auction-icon"></i>
                                <div>{bid.created_at}</div>
                            </div>
                            <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                                {bidBtn}
                                {showItemBtn}
                            </div>
                            </>
                            }
                        </div>
                    )
                }

                if(Date.now() < new Date(bid.auction_item.ends_at)){
                    showItemBtn = <div id={bid.auction_item.item.id} className="btn btn-primary" onClick={handleSeeItemBtn}>See Item</div>
                    bidBtn = <a className="btn-success btn" style={{color:'white'}} onClick={handleBidBtn}>Bid Now</a>
                }else{
                    showItemBtn = <div>Auction has Ended</div>
                    bidBtn = null
                }

                let current_price
                if(item.bids.length){
                    current_price = Math.max(...item.bids.map(bid => bid.price))
                }else{
                    current_price = item.minimum_price
                }

                const bidData = {
                    auction_item_id: bid.auction_item.id,
                    user_id: bid.auction_item.user.id,
                    current_price: current_price
                }

                return (
                    <div key={bid.id} className="bid" style={{margin: '1rem'}}>
                        <div className="list-group-item" style={{display: 'flex', justifyContent: 'flex-end', alignItems: 'center'}}>
                            <h5>{bid.auction_item.item.title}</h5>
                        </div>
                        <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                            <i className="fas fa-dollar-sign auction-icon price-icon"></i>
                            <div>{bid.price} <strong>CZK</strong></div>
                        </div>
                        {infoDisplay === 'bid' ? <Bid bidData={bidData} token={token} setInfoDisplay={setInfoDisplay} getItems={getItems}/> :
                        <>
                        <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                            <i className="fas fa-gavel highest-bidder-icon action-icon"></i>
                            <div>{bid.auction_item.user.first_name + ' ' + bid.auction_item.user.last_name}</div>
                        </div>
                        <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                            <i className="fas fa-clock auction-icon"></i>
                            <div>{bid.created_at}</div>
                        </div>
                        <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                            {bidBtn}
                            {showItemBtn}
                        </div>
                        </>
                        }
                    </div>
                )
            })}
        </div>
    )

}

export default MyBids;