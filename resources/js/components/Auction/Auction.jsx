import React, {useState} from 'react';
import Info from '../Info/Info.jsx';
import Bid from '../Bid/Bid.jsx';
import calculateRemainingTime from '../../helpers/calculateRemainingTime.js'


const Auction = props => {
    console.log('AUCTION PROPS: ',props)
    const {item, userId, token} = {...props}
    const [infoDisplay, setInfoDisplay] = useState('about')
    
    const bidData = {
        auction_items_id: item.id,
        user_id: userId
    }

    // increment={item.minimum_price / 10} itemId={item.id} userId={userId}

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
            <div>Isaac Sackler</div>
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
            <h2>Success</h2>
        </div>
    )


    console.log('ITEM: ', item)

    return (

        <div className="card" style={{maxHeight: '100%', minHeight: '100%'}}>
            <img src={item.item.photo_path} className="card-img-top" alt="..."/>
            <div className="card-body" style={{padding: "0.5rem"}}>
                <h5 className="card-title">{item.item.title}</h5>
                <p className="card-text">{item.item.description}</p>
            </div>
            <ul className="list-group list-group-flush" >
                <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                    <i className="fas fa-hourglass-half auction-icon time-icon"></i>
                    <div>{calculateRemainingTime(item.starts_at, item.ends_at)}</div>
                </div>
                <div className="list-group-item" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                    <i className="fas fa-dollar-sign auction-icon price-icon"></i>
                    <div>{item.minimum_price} <strong>CZK</strong></div>
                </div>
                
                {infoDisplay === 'bid' ? <Bid increment={item.minimum_price / 10} data={bidData} token={token} setInfoDisplay={setInfoDisplay}/> : infoDisplay === 'about' ? about : bidSuccessMessage}
                
            </ul>

            {infoDisplay === 'bid' ? <a className="btn-primary btn" style={{color:'white'}} onClick={handleAboutBtn}>About</a> : <a className="btn-success btn" style={{color:'white'}} onClick={handleBidBtn}>Bid Now</a>}
            
        </div>
    )
}

export default Auction