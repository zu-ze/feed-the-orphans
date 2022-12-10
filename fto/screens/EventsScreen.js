import React, { useState } from "react";
import { Text, View, Button, FlatList, useWindowDimensions} from "react-native";
import { Surface, Card, Paragraph, Avatar, Title} from "react-native-paper";
import Background from "../components/Background";
import {styles} from '../core/Theme'
import { get } from "../core/Utils";
import HTML from 'react-native-render-html';
import {useSelector} from 'react-redux'

export const EventsScreen = ({navigation}) => {
    const isLoggedIn = useSelector( state => state.isLogged);
    const [isLoading, setLoading] = React.useState(false);
    const [events, setEvents] = React.useState([])

    const _getEvents = async () => {
        const json = await get(
            'http://localhost/fto_api/event/read.php'
        );

        if (json.status === true ) {
            setEvents(json.records);
            setLoading(false);
            return;
        } else {
            setLoading(false);
            return
        }
    }

    React.useEffect(() => {
        _getEvents();
    });

    const CardComponent = ({item}) => {
        const LeftContent = props => <Avatar.Icon size={30} icon="folder" /> 
        const contentWidth = useWindowDimensions().width;

        return (
            <Surface style={{marginBottom: 10, width: "100%" }}>
                <Card style={{backgroundColor: "#c5d5e4"}}>
                    <Card.Title title={item.orphanage} left={LeftContent} />
                    <Card.Content>
                        <Title>{item.title}</Title>
                        <Paragraph>
                            <HTML source={{ html: item.description }} contentWidth={contentWidth} />
                        </Paragraph>
                    </Card.Content>
                </Card>
            </Surface>
        )
    }

    return (
        <Background>
        <View style={[styles.container, {flexDirection: "row", width: '98%'}]} >
            {isLoggedIn?
                <View style={{ flex: 1, alignItems: 'top', justifyContent: 'center', height: "100%", width: "100%" }} >
                    {events?                     
                    <FlatList 
                        style={{width: "100%"}}
                        data={events} 
                        renderItem={({item}) => <CardComponent item={item} /> } 
                    />
                    :
                        <Text style={[styles.text]} >No Events</Text>
                    }
                </View>
            :
                <View style={[styles.box,{backgroundColor: "#4b88a2", width: "80%", height: "40%"}]} >
                    <Text style={[styles.text, {textAlign: "center" }]} >You Must Be Logged In to View Events</Text>
                </View>
            }
        </View>
        </Background>
    )
}
