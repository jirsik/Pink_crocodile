import React, { useEffect } from 'react';
import calculateRemainingTime from '../../helpers/calculateRemainingTime.js'
import Countdown from 'react-countdown-now';

const ItemsList = props => {
    
    ////////PROPS////////////

    console.log('LIST PROPS: ', props)
    let items = props.popularityIndex
    const handleShow = props.handleShow


    items = items.map( item => ({
        id: item.id,
        starts_at: item.starts_at,
        ends_at: item.ends_at,
        price: item.minimum_price,
        info: item.item,
        color: item.color
    }))
    
    // console.log('Items List :', items)

    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////
    const upArrow = <i className="far fa-arrow-alt-circle-up popularity-icon" style={{color: 'green'}}></i>
    const downArrow = <i className="far fa-arrow-alt-circle-down popularity-icon" style={{color: 'red'}}></i>
    const staticArrow = <i className="far fa-dot-circle popularity-icon" style={{color: 'black'}}></i>


    return (
        <div className="items-list">
        {items.length && items.map((item) => (

            <div className="item">
                <div className="item-title">{item.info.title}</div>
                {/* <div>{item.info.description}</div> */}
                <div className="item-time-list"><Countdown date={new Date(item.ends_at)}/></div>
                <div className="price-popularity-row">
                    <div className="price-popularity-row--icons">
                        <i className="fas fa-chart-line bids-icon"></i>
                        {/* <i className="fas fa-arrow-up popularity-icon"></i> */}
                        {item.color === 'green' ? upArrow : item.color === 'red' ? downArrow : staticArrow}
                    </div>
                    <div>{item.price} <strong>CZK</strong></div>
                </div>
                <div id={item.id} className="item-show-btn btn-primary btn" onClick={handleShow}>See Item</div>
            </div>

        ))}
        </div>
        
    )
}

export default ItemsList;