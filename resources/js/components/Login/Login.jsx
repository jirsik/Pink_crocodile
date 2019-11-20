import React, {useState} from 'react';

const Login = props => {
    const getToken = props.getToken
    const [formInputValues, setFormInputValues] = useState({email: '', password: '', first_name: '', last_name: ''})
    const [register, setRegister] = useState(false)

    const handleInputChange = (e) => {
        setFormInputValues({
            ...formInputValues,
            [e.target.id]:e.target.value
        })
    }

    const handleLoginButton = (e) => {
        e.preventDefault()

        getToken('login', JSON.stringify({...formInputValues}))
    }
   
    const handleRegisterButton = (e) => {
        e.preventDefault()

        getToken('register', JSON.stringify({...formInputValues}))
    }

    const handleRegisterShowButton = (e) => {
        e.preventDefault()
        setRegister(
            !register
        )
    }

    return (

        <>

            {/* <img class="logo-img" src="./logo.svg" alt=""/> */}
            <div className="logo-img"/>

            <form className="login-form">
                <label htmlFor="email">Email</label>
                <input
                    id="email"
                    type="email"
                    placeholder="Email"
                    value={formInputValues.email}
                    onChange={handleInputChange}
                />
                <label htmlFor="password">Password</label>
                <input
                    id="password"
                    type="password"
                    placeholder="Password"
                    value={formInputValues.password}
                    onChange={handleInputChange}
                />
            
                {register && (
                    <>
                    <label htmlFor="name">Name</label>
                    <input
                        id="name"
                        type="string"
                        placeholder="Name"
                        value={formInputValues.lastName}
                        onChange={handleInputChange}
                    />
                    
                    <label htmlFor="phone">Phone</label>
                    <input
                        id="phone"
                        type="tel"
                        placeholder="Phone"
                        value={formInputValues.lastName}
                        onChange={handleInputChange}
                    />
                    
                    </>
                )}
                
                
            </form>
            <div className="form-btn-container">
                <button className="btn-register btn-pink btn btn-main" onClick={handleRegisterShowButton}>Register</button>
                <button className="btn-success btn btn-main" onClick={handleLoginButton}>Login</button>
            </div>

        </>

    )
}

export default Login;