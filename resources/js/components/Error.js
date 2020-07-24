import React from 'react';

const Error = ({message, clearError}) =>{

    return(
        <div className="errorMessage">
            <span> {message} </span>
            <span className="close"><a onClick={clearError} ><span><i className="fa fa-times"></i></span></a></span>
        </div>
    );
}

export default Error;