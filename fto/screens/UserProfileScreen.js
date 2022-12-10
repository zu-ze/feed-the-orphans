import React, { memo } from "react";
import Background from '../components/Background';
import UserProfileTab from "../components/UserProfileTab";

const UserProfileScreen = ({ navigation }) => {

    return (
        <Background>
            <UserProfileTab />
        </Background>
    )
}

export default memo(UserProfileScreen);