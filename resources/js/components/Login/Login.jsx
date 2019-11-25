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

        <div className="login-display">


            <form className="login-form">
                <div className="logo-img"/>
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
                    <div className="logo-img"/>
                    <label htmlFor="first_name">First Name</label>
                    <input
                        id="first_name"
                        type="string"
                        placeholder="First Name"
                        value={formInputValues.firstName}
                        onChange={handleInputChange}
                    />
                    <label htmlFor="last_name">Last Name</label>
                    <input
                        id="last_name"
                        type="string"
                        placeholder="Last Name"
                        value={formInputValues.lastName}
                        onChange={handleInputChange}
                    />
                    
                    <label htmlFor="phone">Phone</label>
                    <input
                        id="phone"
                        type="tel"
                        placeholder="Phone"
                        value={formInputValues.phone}
                        onChange={handleInputChange}
                    />
                    
                    </>
                )}
                
                
            </form>
            <div className="form-btn-container">
                {!register ? <button className="btn-register btn-pink btn btn-main" onClick={handleRegisterShowButton}>Register</button> :  <button className="btn-register btn-warning btn btn-main" onClick={handleRegisterShowButton}>Back</button>}
                {!register ? <button className="btn-success btn btn-main" onClick={handleLoginButton}>Login</button> : <button className="btn-primary btn btn-main" onClick={handleRegisterButton}>Submit</button>}
            </div>

        </div>

    )
}

export default Login;