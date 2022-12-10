import React, { useState } from "react";
import { Text, View, FlatList, Button} from "react-native";
import Background from "../components/Background";
import {styles} from '../core/Theme'
import { useSelector } from 'react-redux'
import { post } from "../core/Utils";

export const NotificationScreen = () => {
    const [notifications, setNotifications] = useState();
    const isLoggedIn = useSelector( state => state.isLogged);
    const user = useSelector( state => state.user );
    const [isLoaded, setIsLoaded] = useState(false);

    React.useEffect( () => {
        if (isLoggedIn === true)
            // if (isLoaded === false) {
                _loadNotification();
                // setIsLoaded(true);
            // }
    });

    const _loadNotification = async () => {
        const json = await post(
            'http://localhost/fto_api/notification/read_where.php',
            {
                "type": "userId",
                "userId": user.id
            }
        )

        if (json.status === true) {
            setNotifications(json.records);
        }
    }

    const seen = (id) => {

    }

    const Notify = ({item, seen}) => {
        return (
            <View style={
                { 
                    flex: 1, 
                    flexDirection: "column",
                    padding: 15,
                    backgroundColor: "#4b88a288",
                    borderBottomWidth: 1,
                    borderBottomColor: "#eee",
                    height: 50,
                    width: '100%',
                    alignItems: "center",
                    }}>
                <Text style={{ fontSize: "18"}} >{item.message}</Text>
                {/* <Button style={{
                    height: 5
                }}
                onPress={
                    () => {
                        seen(item.id)
                    }
                }
                    title="Mark as read"
                >
                </Button> */}
            </View>
        )
    }

    return (
        <Background>
            {isLoggedIn? 
                <View style={{ flex: 1, alignItems: 'top', justifyContent: 'center', height: "100%", width: "100%" }} >
                    <FlatList 
                        style={{width: "100%"}}
                        data={notifications} 
                        renderItem={({item}) => <Notify item={item} seen={seen} /> } 
                    />
                </View>
            :
                <View style={[styles.box,{backgroundColor: "#4b88a2", width: "80%", height: "40%"}]} >
                    <Text style={[styles.text, {textAlign: "center" }]} >You Must Be Logged In to View Notifications</Text>
                </View>
            }
        </Background>
    )
}
