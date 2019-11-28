import React, { useState, useEffect } from 'react';

import Nav from './Nav/Nav.jsx';
import Login from './Login/Login.jsx';
import Auction from './Auction/Auction.jsx';
import ContainerBtns from './ContainerBtns/ContainerBtns.jsx';
import ItemsList from './ItemsList/ItemsList.jsx';
import MyBidsList from './MyBidsList/MyBidsList.jsx';
import Edit from './Edit/Edit.jsx';

let getItemsInterval

const App = props => {

        /////AUTH//////
    const [token, setToken] = useState(window.localStorage.getItem('_token'))
    const [loggedIn, setLoggedIn] = useState(token ? true : false)
    const [user, setUser] = useState(loggedIn ? JSON.parse(window.localStorage.getItem('_user')) : {id:0}) //Storing user details in local storage or cookie ???
    /////ITEMS//////
    const [items, setItems] = useState([])
    const [currentItemId, setCurrentItemId] = useState(0)
    /////DISPLAY////// [show, list, myBids, logIn]
    const [display, setDisplay] = useState('show')
    const [infoDisplay, setInfoDisplay] = useState('about')
    const [popularityIndex, setPopularityIndex] = useState([])
    const [message, setMessage] = useState(null)
    const [loading, setLoading] = useState(true)


    //////////////////////////////////////////////////////
                    // AUTHORISATION //
    ///////////////////////////////////////////////////////

    function getToken (type, input) {

        console.log('LOGIN INPUT: ', input)

        fetch(`/api/auth/${type}`, {
            method: 'POST',
            withCredentials: true,
            credentials: 'include',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'Accept' : 'application/json'
            },
            body: input
        })
        .then((response) => response.json())
        .then((response) => {
            console.log('login resonse ',response)
            if(!response.error){
                setToken(response.token)
                window.localStorage.setItem('_token', response.token)
                setUser(response.user)
                window.localStorage.setItem('_user', JSON.stringify(response.user)) ///!!!!!!!!!!!!!!!!!!!!
                setLoggedIn(true)
                setDisplay('show')
            }else{
                setMessage('invalid')
            }
        })
        .catch((error) => {
            console.log(error)
        })
    }

    //////////////////////////////////////////////////////
                        // DISPLAY //
    ///////////////////////////////////////////////////////

    const getItems = (url) => {
        fetch(`/api/${url}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+ token,
                'Accept' : 'application/json'
            },
        })
        .then((response) => response.json())
        .then((response) => {
            console.log('RESPONSE: ', response)
            // console.log('MAP: ', response.map(item => item.item.item_photo_path ? item.item.item_photo_path = item.item.item_photo_path : item.item.item_photo_path = '../img/logo.svg'))
            // setItems(response.map(item => item.item.item_photo_path ? item.item.item_photo_path = item.item.item_photo_path : item.item.item_photo_path = '../img/logo.svg'))
            setItems(response.map(object => {
                if(object.item.item_photo_path){
                    return object
                }else{
                    object.item.item_photo_path = './uploads/items/item.png'
                    return object
                }
            }))
        })
    }


    const setDisplayTypeBtn = (e) => {
        setDisplay(e.target.id)
    }

    const changeIndex = (e) => {
        if(currentItemId === items.length - 1 && e.target.id === 'next'){
            setCurrentItemId(0)
        }else if(currentItemId === 0 && e.target.id === 'previous'){
            setCurrentItemId(items.length-1)
        }else if(e.target.id === 'previous'){
            setCurrentItemId(i => --i)
        }else if(e.target.id === 'next'){
            setCurrentItemId(i => ++i)
        }

        setInfoDisplay('about')
    }

    const handleShow = (e) => {
        console.log('E: ', e.target.id)
        setCurrentItemId(e.target.id - 1)
        setDisplay('show')
    }

    
    useEffect(() => {
        getItems('landing')
        setCurrentItemId(0)
        console.log('LOADED')
        setTimeout(() => {
            setLoading(false)
        }, 1000)

        // getItemsInterval = setInterval(() => {
        //     getItems('landing')
        // }, 10000)
        // console.log('Items CompDidMount: ',items)
        // return () => {
        //     clearInterval(getItemsInterval)
        // }
    }, [])

    useEffect(() => {
        setPopularityIndex(prevState => {
            //SORT ITEMS BY NUMBER OF BIDS AND CREATE NEW ARRAY
            const newState = items.slice(0).sort((a,b) => b.bids.length - a.bids.length)
            //IF THERE ARE NO BIDS RETURN NEW ARRAY
            if(prevState.length === 0){
                return newState
            //ELSE COMPARE INDEXES AND COLOR CODE
            }else{
                return newState.map(item => {
                    const prevStateIndex = prevState.findIndex(x => x.id === item.id)
                    const newStateIndex = newState.findIndex(x => x.id === item.id)
                    prevStateIndex > newStateIndex ? item.color = 'green' : prevStateIndex < newStateIndex ? item.color = 'red' : item.color = 'black'
                    return item
                })
            }
        })
    }, [items])
    
    
    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////

    // token && console.log('TOKEN ', token)
        // token && console.log('LOCAL STORAGE: ',window.localStorage.getItem('_token'))
    
    // console.log('USER: ', user)

    // console.log('ITEMS: ', items)
    
    let messageDiv
    if(message === 'invalid'){
        messageDiv = (
            <div style={{border: '1px solid rgba(214, 0, 110, 0.6)', width:'100%', padding:'0.5rem', margin:'0.5rem', color: 'red'}}>
                <h6 style={{fontWeight: '600'}}>Log in credentials invalid, please try again</h6>
            </div>
        )
    }else if(message ==='password-mismatch'){
        messageDiv = (
            <div style={{border: '1px solid rgba(214, 0, 110, 0.6)', width:'100%', padding:'0.5rem', margin:'0.5rem', color: 'red'}}>
                <h6 style={{fontWeight: '600'}}>Passwords do not match, please try again</h6>
            </div>
        )
    }
    console.log('LOADING: ',loading)
    const showOrHide = loading ? {visibility: 'hidden'} : {visibility: 'visible'}

    return (
        <div style={showOrHide}>
            {!loading && <Nav setDisplay={setDisplay} loggedIn={loggedIn} setLoggedIn={setLoggedIn} loading={loading} />}
            
            <div className="main-container">
                
                <ContainerBtns setDisplayTypeBtn={setDisplayTypeBtn} display={display} loggedIn={loggedIn} />

                <div className="main">
                    {
                        display === 'show' && 
                            <div id='previous' className="direction-btn direction-btn_left" onClick={changeIndex} >&lt;</div>
                    }
                    <div className="display">
                        {display === 'logIn' && <Login getToken={getToken} messageDiv={messageDiv} setMessage={setMessage}/>}
                        {display === 'list' && <ItemsList popularityIndex={popularityIndex} handleShow={handleShow}/>}
                        {display === 'show' && items.length > 0 && <Auction item={items[currentItemId]} user={user} token={token} getItems={getItems} infoDisplay={infoDisplay} setInfoDisplay={setInfoDisplay} loggedIn={loggedIn} setDisplay={setDisplay}/>}
                        {display === 'myBids' && <MyBidsList items={items} user={user} token={token} setCurrentItemId={setCurrentItemId} setDisplay={setDisplay} getItems={getItems} />}
                        {display === 'account' && <Edit user={user} token={token}/>}
                    </div>
                    {
                        display === 'show' &&
                            <div id='next' className="direction-btn direction-btn_right" onClick={changeIndex}>&gt;</div>
                    }

                </div>
            </div>
        </div>
    )
}


export default App;





