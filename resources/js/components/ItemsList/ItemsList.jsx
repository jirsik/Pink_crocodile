import React, { useEffect } from 'react';
import Countdown from 'react-countdown-now';

import formatNumber from '../../helpers/formatNumber';
import findOrdinalSuffix from '../../helpers/findOrdinalSuffix';

const ItemsList = props => {
    
    ////////PROPS////////////

    console.log('LIST PROPS: ', props)
    let items = props.popularityIndex
    const handleShow = props.handleShow


    items = items.map( item => ({
        id: item.id,
        starts_at: item.starts_at,
        ends_at: item.ends_at,
        price: item.bids.length ? Math.max(...item.bids.map(bid => bid.price)) : item.minimum_price,
        info: item.item,
        color: item.color
    }))
    
    // console.log('Items List :', items)

    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////
    const upArrow = <i className="far fa-arrow-alt-circle-up popularity-icon" style={{color: 'green'}}></i>
    const downArrow = <i className="far fa-arrow-alt-circle-down popularity-icon" style={{color: 'red'}}></i>
    const staticArrow = <i className="fas fa-minus popularity-icon" style={{color: 'black'}}></i>
    
    return (
        <div className="items-list">
            <div className="title-container">
                {/* <img className="title-img" src="../images/logo.svg"></img> */}
                <div className="title-img"/>
                <h1 className="pink">Hot List</h1>
            </div>

            {items.length && items.map((item, i) => (

                <div key={i} className="item">
                    <div className="item-title">{item.info.title}</div>
                    <div className="item-time-list" style={Date.now() > new Date(item.ends_at) ? {color: 'red'} : {color:'green'}}><Countdown date={new Date(item.ends_at)}/></div>
                    <div className="price-popularity-row">
                        <div className="price-popularity-row--icons">
                            <i className="fas fa-chart-line bids-icon"></i>
                            {/* {item.color === 'green' ? upArrow : item.color === 'red' ? downArrow : staticArrow} */}
                            <div className="popularity-icon">{findOrdinalSuffix(i+1)}</div>
                        </div>
                        <div>{formatNumber(item.price)} <strong>CZK</strong></div>
                    </div>
                    <div id={item.id} className="item-show-btn btn-primary btn" onClick={handleShow}>See Item</div>
                </div>

            ))}
        </div>
        
    )
}

export default ItemsList;